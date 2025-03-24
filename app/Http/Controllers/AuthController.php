<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // This is the AuthController responsible for handling authentication-related actions.
    // You can add methods for login, registration, and logout here.

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $userExists = User::where('email', $request->email)->exists();

        if (Auth::attempt($request->only('email', 'password'), true)) {
            return redirect()->route('admin.courses.dashboard');
        }

        if (!$userExists) {
            return redirect()->route('register')->with('message', 'It seems you don’t have an account yet. Please register to continue.')->withInput();
        }

        return redirect()->back()->with('error', 'The provided credentials are incorrect. Please try again.')->withInput();
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/', // at least one uppercase letter
                'regex:/[a-z]/', // at least one lowercase letter
                'regex:/[0-9]/', // at least one digit
                'regex:/[@$!%*?&]/' // at least one special character
            ],
            'role' => 'required|string'
        ], [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]);

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect()->route('login')->with('message', 'You are already registered. Please log in to your account.');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user, true);
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}