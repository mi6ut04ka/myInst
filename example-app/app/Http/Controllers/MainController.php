<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Session;

class MainController extends Controller
{
    private Request $request;

    public function __construct()
    {
        $this->request = request();
    }

    public function index(Request $request) : View
    {
        $posts = Post::with('owner')->orderBy('created_at', 'desc')->take(3)->get();
        $user = Auth::user();
        return view('index', compact('posts', 'user'));
    }

    public function login() : View
    {
        return view('auth.login');
    }
    public function register() : View
    {
        return view('auth.register');
    }

    public function authorization(): RedirectResponse
    {
        $user = User::whereUsername(request('username'))->first();
        if (!$user || !\Hash::check(request('password'), $user->password)) {
        Session::flash('error', 'Вы ввели неправильный логин или пароль');
        return redirect()->back();
    }
            Auth::login($user);
            return to_route('home');
    }

    public function registration(): RedirectResponse
    {
        $user = User::whereUsername(request('username'))->first();
        if ($user){
            Session::flash('error', 'Пользователь с таким именем уже существует');
            return redirect()->back();
        }
        if(request('password') !== request('password_confirmation')){
            Session::flash('error', 'Введите корректный пароль для подтвержения');
            return redirect()->back();
        }
        $newUser = User::create([
            'username' => request('username'),
            'password' => Hash::make(request('password')),
        ]);
        Auth::login($newUser);
        return to_route('home');

    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return to_route('auth.login');
    }

    public function profile(): View
    {
        $user = Auth::user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        return \view('profile', compact('user', 'posts'));
    }

    public function subscribe(User $user): JsonResponse
    {
        $currentUser = Auth::user();


        if(!$currentUser->id == $user->id){
            return response()->json(['message' => 'Вы не можете подписаться на себя.'], 400);
        }

        if($currentUser->following()->where('author_id', $user->id)->exists()){
            return response()->json(['message' => 'Вы уже подписаны на этого пользователя.'], 400);
        }
        else{
            $currentUser->following()->attach($user);
        }


        return response()->json(['message' => 'Вы успешно подписались на пользователя!']);
    }
    public function unsubscribe(User $user): RedirectResponse
    {
        $currentUser = auth()->user();

        if ($currentUser->following()->where('author_id', $user->id)->exists()) {
            $currentUser->following()->detach($user->id); // Отписка от пользователя
            return redirect()->back()->with('success', 'Вы отписались от пользователя');
        } else {
            return redirect()->back()->with('error', 'Вы не подписаны на этого пользователя');
        }
    }


}
