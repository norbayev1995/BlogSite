@extends('layouts.app')
@section('title', 'Edit Profile - Blog Site')
@section('content')
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>
            <form action="{{ route('update-profile',['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ $user->name }}">
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ $user->username }}">
                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" id="email" name="email" rows="4" required value="{{ $user->email }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Avatar</label>
                    <input type="file" id="avatar" name="image" accept="image/*"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="mt-2 text-sm text-gray-500">Current Avatar: {{ $user->image->url }}</p>
                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <hr class="my-6">
                <div class="flex items-center space-x-4">
                    <div class="mb-4 w-1/2">
                        <label for="old_password" class="block text-sm font-medium text-gray-700">Old Password</label>
                        <input type="password" id="old_password" name="old_password"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('old_password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4 w-1/2">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" id="new_password" name="new_password"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update
                    Profile</button>
            </form>
            <a href="{{ route('user-profile') }}" class="text-indigo-600 hover:text-indigo-800 block mt-4 text-center">Back to
                Profile</a>
        </div>
    </main>
@endsection
