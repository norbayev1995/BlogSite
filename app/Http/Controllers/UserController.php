<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id);
        return view('user.index', compact('users'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function editProfile($id)
    {
        $user = User::find($id);
        return view('user.edit-profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->update();
        if ($request->hasFile('image')) {
            if (Storage::exists('storage/'.$user->image->url)){
                Storage::delete('storage/'.$user->image->url);
            }
            $file = $request->file('image');
            $extension = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('images', $extension, 'public');
            $user->image()->create(['url' => 'images/'.$extension]);
        }
        return redirect()->route('user-profile');
    }
}
