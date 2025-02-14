@extends('layouts.app')
@section('title', 'Post Title - Blog Site')
@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <article class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            <img src="{{ asset('storage/'.$post->image->url) }}" alt="Post Image" class="w-full h-64 object-cover rounded-lg mb-4">
            <p class="text-gray-700 mb-6">{{ $post->description }}</p>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('posts.edit', ['post' => $post]) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
            </div>

            <h2 class="text-2xl font-bold mb-4">Comments</h2>
            <div class="space-y-4 mb-6">
                @forelse($post->comments as $comment)
                    <div class="bg-gray-50 p-4 rounded-lg flex justify-between">
                        <div>
                            <p class="font-semibold">{{ $comment->user->name }}</p>
                            <p class="text-gray-700">{{ $comment->content }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <form action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center">No comments</div>
                @endforelse
            </div>

            <form action="{{ route('comments.store', ['id' => $post->id]) }}" method="post">
                @csrf
                <h3 class="text-xl font-bold mb-2">Add a Comment</h3>
                <textarea id="comment" name="content" rows="3" required
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Write your comment here..."></textarea>
                <button type="submit"
                        class="mt-2 bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit
                    Comment</button>
            </form>
        </article>
    </main>
@endsection
