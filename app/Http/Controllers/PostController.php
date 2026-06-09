<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/dashboard')->with('message', 'Please log in first.');
        }

        $incomingFields = $request->validate([
            'title'          => 'required',
            'body'           => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body']  = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = Auth::id();

        if ($request->hasFile('featured_image')) {
            $incomingFields['featured_image'] = $request->file('featured_image')
                ->store('post-images', 'public');
        }

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
            'title'          => 'required',
            'body'           => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body']  = strip_tags($incomingFields['body']);

        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $incomingFields['featured_image'] = $request->file('featured_image')
                ->store('post-images', 'public');
        }

        $post->update($incomingFields);
        return redirect('/dashboard');
    }

    public function deletePost(Post $post)
    {
        if (Auth::id() === $post->user_id) {
            // Delete image file too
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->delete();
        }
        return redirect('/dashboard');
    }
}