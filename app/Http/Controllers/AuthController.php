<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ["bail", 'required', 'email', 'exists:users'],
            'password' => ['required']
        ]);

        try {
            $user = User::where('email', $request->email)->firstOrFail();
            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors(['email' => 'Invalid credentials']);
            }
            
            // Create session for the user
            auth()->login($user);
            
            return redirect()->route('dashboard');
        } catch (ModelNotFoundException $e) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'role' => ['required', Rule::in(['admin', 'learner'])],
            'firstName' => ['required'],
            'lastName' => ['required'],
        ]);

        try {
            $user = User::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'username' => strtolower($request->firstName . '.' . $request->lastName), // Generate username from name
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('login')
                ->with('success', 'Account created successfully! Please login.');
        } catch (QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Registration failed. Please try again.');
        }
    }
}
