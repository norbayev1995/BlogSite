<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function followNotifications()
    {
        $notifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\FollowedNotification');
        return view('notifications.index', compact('notifications'));
    }

    public function commentNotifications()
    {
        $notifications = auth()->user()->unreadNotifications->where('type', 'App\Notifications\CommentsNotification');
        return view('notifications.comment', compact('notifications'));
    }

    public function read($id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
