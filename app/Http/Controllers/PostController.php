<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allPosts()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }

    public function followedPosts()
    {
        $user = auth()->user();
        $followedUserIds = $user->following()->pluck('users.id');
        $posts = Post::whereIn('user_id', $followedUserIds)->latest()->get();
        return view('posts.followedPosts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = auth()->user()->id;
        $post->save();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('images', $extension, 'public');
            $post->image()->create(['url' => 'images/'.$extension]);
        }
        return redirect()->route('allPosts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (auth()->user()->isOwnerOf($post)){
            return view('posts.edit', compact('post'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (auth()->user()->isOwnerOf($post)){
            $post->title = $request->title;
            $post->description = $request->description;
            $post->update();
            if ($request->hasFile('image')) {
                if (Storage::exists('storage/'.$post->image->url)){
                    Storage::delete('storage/'.$post->image->url);
                    $post->image()->delete();
                }
                $file = $request->file('image');
                $extension = time().'.'.$file->getClientOriginalExtension();
                $file->storeAs('images', $extension, 'public');
                $post->image()->create(['url' => 'images/'.$extension]);
            }
            return redirect()->route('allPosts');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->isOwnerOf($post)){
            if (asset('storage/'.$post->image->url)){
                unlink('storage/'.$post->image->url);
                $post->image()->delete();
            }
            $post->delete();
            return redirect()->route('allPosts');
        }
        return redirect()->back();
    }
}
