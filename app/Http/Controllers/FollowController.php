<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FollowedNotification;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow($id)
    {
        $user = User::find($id);
        auth()->user()->following()->sync($user->id);
        $user->notify(new FollowedNotification(auth()->user()));
        return redirect()->back();
    }
    public function unfollow($id)
    {
        $user = User::find($id);
        auth()->user()->following()->detach($user->id);
        return redirect()->back();
    }
}
