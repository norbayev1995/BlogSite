@extends('layouts.app')
@section('title', 'User Profile - Blog Site')
@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex flex-col sm:flex-row items-center mb-4">
                    <img src="{{ asset('storage/'.auth()->user()->image->url) }}" alt="User Avatar"
                         class="w-20 h-20 rounded-full mr-4 mb-4 sm:mb-0">
                    <div class="text-center sm:text-left">
                        <h1 class="text-2xl font-bold">{{ auth()->user()->name }}</h1>
                        <p class="text-gray-600">{{ auth()->user()->username }}</p>
                    </div>

                    <!-- Follow/Unfollow Button and Edit Profile -->
                    <div class="mt-4 sm:mt-0 sm:ml-auto">
                        <!-- Edit Profile button for current user's profile -->
                        <!-- Assuming you will check if this is the current user's profile -->
                        <a href="{{ route('edit-profile', ['id' => auth()->user()->id]) }}"
                           class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center sm:justify-start space-x-4">
                    <span class="font-semibold">150 Followers</span>
                    <span class="font-semibold">100 Following</span>
                    <span class="font-semibold">50 Posts</span>
                </div>
            </div>


            <h2 class="text-2xl font-bold mb-4">My Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="./images/post-image.png" alt="Post Image"
                         class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold mb-2">Post Title 1</h3>
                    <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <div class="flex space-x-2">
                        <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
                        <a href="edit-post.html" class="text-green-600 hover:text-green-800">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="./images/post-image.png" alt="Post Image"
                         class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold mb-2">Post Title 2</h3>
                    <p class="text-gray-700 mb-4">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat.</p>
                    <div class="flex space-x-2">
                        <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
                        <a href="edit-post.html" class="text-green-600 hover:text-green-800">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
