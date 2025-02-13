@extends('layouts.app')
@section('title', 'All Posts - Blog Site')
@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">All Posts</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="{{ asset('storage/'.$post->image->url) }}" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h2 class="text-xl font-bold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $post->description }}</p>
                    <p class="text-gray-700 mb-4">By <a href="{{ route('user-profile', ['id' => $post->user->id]) }}"
                                                        class="text-indigo-600 hover:text-indigo-800">{{ $post->user->name }}</a>
                    </p>
                    <a href="{{ route('posts.show', ['post' => $post]) }}" class="text-indigo-600 hover:text-indigo-800">Read More</a>
                </div>
            @empty
                <div class="alert alert-danger">Nothing</div>
            @endforelse
        </div>
    </main>
@endsection
