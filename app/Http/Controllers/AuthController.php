<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function LoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $user = User::where($loginType, $request->username)->first();
        if (!$user) {
            return back()->withErrors([
                'username' => "We couldn't find an account with that " . ($loginType == 'email' ? 'email' : 'username') . ".",
            ]);
        }

        $credentials = [
            $loginType => $request->username,
            'password' => $request->password,
        ];
        $remember = $request->has('remember');

        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors([
                'username' => 'Please verify your email first.',
            ]);
        }

        if ($user->role != 'admin') {
            return back()->withErrors([
                'username' => 'You are not an admin.',
            ]);
        }

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin-home');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function signupForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|min:3|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'tos' => 'required|in:on',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->sendEmailVerificationNotification();
        Auth::login($user);
        return redirect()->route('home');
    }
}
