<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\SendEmailNotification;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->verification_token = Str::random(64);
        $user->save();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $extension, 'public');
            $user->image()->create(['url' => 'images/'.$extension]);
        }
        $mail = Mail::to($user->email)->send(new SendEmailNotification($user));
        if ($mail) {
            return redirect()->route('loginPage')->with('success', 'Регистрация прошла успешно! Проверьте вашу почту для подтверждения.');
        }
    }

    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        $user = User::where('verification_token', $token)->firstOrFail();
        $user->email_verified_at = now();
        $user->update();
        return redirect()->route('loginPage');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        if (Auth::attempt($validated)){
            $user = Auth::user();
            if (is_null($user->email_verified_at)){
                Auth::logout();
                return redirect()->route('loginPage');
            }
            return redirect()->route('dashboard');
        }
        return redirect()->route('loginPage');
    }
}
