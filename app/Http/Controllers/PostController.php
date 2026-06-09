<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

// class PostController extends Controller
// {
//     public function createPost(Request $request){
//         $incomingFields = $request->validate([
//             'title' => 'required',
//             'body' => 'required'
//         ]);

//         $incomingFields['title'] = strip_tags($incomingFields['title']);
//         $incomingFields['body'] = strip_tags($incomingFields['body']);
//         $incomingFields['user_id'] = Auth::id();

//         Post::create($incomingFields);
//         return redirect('/dashboard');
//     }

//     public function showEditScreen(Post $post){
//         if(Auth::id() !== $post['user_id']){
//             return redirect('/');
//         }
//         return view('edit-post', ['post' => $post]);
//     }

//     public function updatePost(Post $post, Request $request){
//         if(Auth::id() !== $post['user_id']){
//             return redirect('/dashboard');
//         }
//         $incomingFields = $request->validate([
//             'title' => 'required',
//             'body' => 'required'
//         ]);
//         $incomingFields['title'] = strip_tags($incomingFields['title']);
//         $incomingFields['body'] = strip_tags($incomingFields['body']);

//         $post->update($incomingFields);
//         return redirect('/dashboard');
//     }

//     public function deletePost(Post $post){
//         if(Auth::id() === $post['user_id']){
//             $post->delete();
//         }
//         return redirect('/dashboard');
//     }
// }
class PostController extends Controller
{
    // public function createPost(Request $request)
    // {
    //     $incomingFields = $request->validate([
    //         'title' => 'required',
    //         'body' => 'required'
    //     ]);

    //     $incomingFields['title'] = strip_tags($incomingFields['title']);
    //     $incomingFields['body'] = strip_tags($incomingFields['body']);
    //     $incomingFields['user_id'] = auth()->id();

    //     Post::create($incomingFields);
    //     return redirect('/dashboard');
    // }
    public function createPost(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/dashboard')->with('message', 'Please log in first to publish a post.');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id();

        Post::create($incomingFields);
        return redirect('/dashboard');
    }
    public function showEditScreen(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect('/dashboard');
        }
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/dashboard');
    }

    public function deletePost(Post $post)
    {
        if (Auth::id() === $post->user_id) {
            $post->delete();
        }
        return redirect('/dashboard');
    }
}
