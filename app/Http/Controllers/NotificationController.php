<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('notifications.index', compact('notifications'));
    }

    public function read($id)
    {
        $notifications = auth()->user()->unreadNotifications->where('id', $id)->first();
        $notifications->markAsRead();
        return redirect()->back();
    }
}
