<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Events\CommentAdded;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment = new Comment();
        $comment->text = $validated['content'];
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();
        $comment->load('user');

        broadcast(new CommentAdded($comment))->toOthers();

        return response()->json(['comment' => $comment], 201);
    }
}
