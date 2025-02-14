@extends('layouts.app')
@section('title', 'Author Profile - Blog Site')
@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex flex-col sm:flex-row items-center mb-4">
                    <img src="{{asset('storage/'.$user->image->url)}}" alt="User Avatar"
                         class="w-20 h-20 rounded-full mr-4 mb-4 sm:mb-0">
                    <div class="text-center sm:text-left">
                        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->username }}</p>
                    </div>

                    <!-- Follow/Unfollow Button and Edit Profile -->
                    <div class="mt-4 sm:mt-0 sm:ml-auto">
                        <!-- Conditional Follow/Unfollow -->
                        <!-- Assuming you have some backend logic to check if the user is already followed -->
                        @if(auth()->user()->isFollowing($user))
                            <form action="{{ route('unfollow', $user->id) }}" method="post">
                                @csrf
                                <button id="followButton"
                                        type="submit"
                                        class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Unfollow
                                </button>
                            </form>
                        @else
                            <form action="{{ route('follow', $user->id) }}" method="post">
                                @csrf
                                <button id="followButton"
                                        type="submit"
                                        class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Follow
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="flex flex-wrap justify-center sm:justify-start space-x-4">
                    <span class="font-semibold">150 Followers</span>
                    <span class="font-semibold">100 Following</span>
                    <span class="font-semibold">50 Posts</span>
                </div>
            </div>


            <h2 class="text-2xl font-bold mb-4">User's Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="./images/post-image.png" alt="Post Image"
                         class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold mb-2">Post Title 1</h3>
                    <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="./images/post-image.png" alt="Post Image"
                         class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold mb-2">Post Title 2</h3>
                    <p class="text-gray-700 mb-4">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat.</p>
                    <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
                </div>
            </div>
        </div>
    </main>
@endsection
