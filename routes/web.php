<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/science', function () {
    return view('science');
});
Route::get('/technology', function () {
    return view('technology');
});
Route::get('/mathematics', function () {
    return view('mathematics');
});
Route::get('/engineering', function () {
    return view('engineering');
});
Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/dashboard', function () { 
    // pel mean acc to show all posts if logged in, otherwise show empty dashboard
    $posts = [];
    if (Auth::check()) {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
    }
    return view('dashboard', ['posts' => $posts]);
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

// CHANGED: news now pulls all posts from the database
Route::get('/news', function () {
    // pel mean acc to show all posts in news 
    // CHANGED: pull all posts from the database and pass to the news view
    //
    $posts = Post::latest()->get();
    return view('news', ['posts' => $posts]);
});

Route::get('/bookmarks', fn() => view('bookmarks'));