<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

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
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->description = $request->description;
        $post->update();
        if ($request->hasFile('image')) {
            if (asset('storage/'.$post->image->url)){
                unlink('storage/'.$post->image->url);
                $post->image()->delete();
            }
            $file = $request->file('image');
            $extension = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('images', $extension, 'public');
            $post->image()->create(['url' => 'images/'.$extension]);
        }
        return redirect()->route('allPosts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (asset('storage/'.$post->image->url)){
            unlink('storage/'.$post->image->url);
            $post->image()->delete();
        }
        $post->delete();
        return redirect()->route('allPosts');
    }
}
