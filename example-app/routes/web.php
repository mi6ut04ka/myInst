<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::middleware('guest')->group(function () {
    Route::get('/login',[MainController::class,'login'])->name('auth.login');
    Route::post('/login',[MainController::class,'authorization'])->name('auth.login');
    Route::get('/register',[MainController::class,'register'])->name('auth.register');
    Route::post('/register',[MainController::class, 'registration'])->name('auth.register');
});


Route::middleware('auth')->group(function(){
    Route::get('/',[MainController::class,'index'])->name('home');
    Route::get('/logout',[MainController::class,'logout'])->name('auth.logout');
    Route::get('profile',[MainController::class,'profile'])->name('profile');
    Route::post('/subscribe/{user}',[MainController::class,'subscribe'])->name('subscribe');
    Route::delete('/unsubscribe/{user}', [MainController::class, 'unsubscribe'])->name('unsubscribe');

    Route::prefix('/posts')->name('posts.')->group(function(){
        Route::get('/load-more', [PostController::class, 'loadMorePosts'])->name('loadMore');
        Route::get('/upload',[PostController::class,'create'])->name('create');
        Route::post('/upload',[PostController::class,'store'])->name('store');
        Route::post('/{post}/like', [PostController::class, 'like'])->name('like');
    });
    Route::prefix('/comments')->name('comments.')->group(function(){
        Route::post('/{post}/upload', [CommentController::class, 'store'])->name('store');
    });
    Route::prefix('/avatar')->name('avatar.')->group(function(){
        Route::post('/upload', [AvatarController::class, 'store'])->name('store');
    });
});



