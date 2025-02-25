<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }


    public function adminShow($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }



    public function adminIndex()
    {
        // Fetch all posts or modify to display only posts for admin users
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts.home', compact('posts')); // Change to home.blade.php
    }


    // Show a single post
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Show create post form (only for authenticated users)
    public function create()
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Unauthorized Access');
        }
        return view('admin.posts.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate the image
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();  // Create a unique name for the image
            $request->image->move(public_path('images'), $imageName);  // Move image to the public/images directory
        } else {
            $imageName = null;  // If no image, set it as null
        }

        // Create the post and save to database
        Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'author_name' => Auth::check() ? Auth::user()->name : 'Guest',  // Default to 'Guest' if not authenticated
            'image' => $imageName,  // Store image name/path
            'published_at' => now(),
        ]);

        return redirect(route('admin.posts'))->with('success', 'Post created successfully!');
    }



    // Show edit form (only for the author)
    // Show edit form (only for the author)
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Check if the authenticated user is the author of the post
        if (Auth::user()->name !== $post->author_name) {
            return redirect('/')->with('error', 'Unauthorized Access');
        }

        return view('admin.posts.edit', compact('post'));
    }


    // Update post
    // Update post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Check if the authenticated user is the author of the post
        if (Auth::user()->name !== $post->author_name) {
            return redirect('/')->with('error', 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $post->update($request->only(['title', 'content']));

        return redirect(route('admin.posts'))->with('success', 'Post updated successfully!');
    }

    // Delete post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::user()->name !== $post->author_name) {
            return redirect(route('admin.posts'))->with('error', 'Unauthorized Access');
        }

        // Delete the image file if it exists
        if ($post->image) {
            $imagePath = public_path('images/' . $post->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $post->delete();

        return redirect(route('admin.posts'))->with('success', 'Post deleted successfully!');
    }



}
