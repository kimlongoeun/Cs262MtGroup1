<?php
// app/Http/Controllers/Api/PostController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // Get all published posts
    public function index()
    {
        $posts = Post::with('user')
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        return response()->json($posts);
    }

    // Get single post
    public function show($slug)
    {
        $post = Post::with('user')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment views
        $post->increment('views');

        return response()->json($post);
    }

    // Create new post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status ?? 'draft',
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return response()->json($post, 201);
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        // Check authorization
        if ($request->user()->id !== $post->user_id && !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'status' => 'in:draft,published',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post->update($request->only(['title', 'content', 'status']));

        if ($request->status === 'published' && !$post->published_at) {
            $post->update(['published_at' => now()]);
        }

        return response()->json($post);
    }

    // Delete post
    public function destroy(Request $request, Post $post)
    {
        // Check authorization
        if ($request->user()->id !== $post->user_id && !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    // Get current user's posts
    public function myPosts(Request $request)
    {
        $posts = $request->user()
            ->posts()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($posts);
    }
}
