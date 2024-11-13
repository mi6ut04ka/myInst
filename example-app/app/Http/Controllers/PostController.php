<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class PostController extends Controller
{

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required|max:255|min:3|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20400',
        ]);


        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public');

            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize(public_path('storage/'.$path));

            $post = Post::create([
                'content' => $request->get('description'),
                'owner_id' => auth()->id(),
            ]);
            Photo::create([
                'post_id' => $post->id,
                'path' => $path,
                'uuid'=> (string) Str::uuid()
            ]);
        }
        return redirect()->back()->with('success', 'Пост создан');
    }

    public function like(Post $post): JsonResponse
    {
        $user = auth()->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->detach($user->id);
            $liked = false;
        } else {
            $post->likes()->attach($user->id);
            $liked = true;
        }

        return response()->json(['liked' => $liked]);
    }
    public function loadMorePosts(Request $request): JsonResponse
    {
        $skip = $request->input('skip', 0);
        $posts = Post::with('owner')->orderBy('created_at', 'desc') // Сортировка по дате создания
        ->skip($skip)
        ->take(3)
        ->get();

        if ($posts->isEmpty()) {
            return response()->json(['html' => '', 'count' => 0]);
        }
        $html='';
        foreach ($posts as $post) {
            $comments = $post->comments;
            $html .= view('components.post',compact('post', 'comments') );
        }

        return response()->json(['html' => $html, 'count' => $posts->count()]);
    }
}
