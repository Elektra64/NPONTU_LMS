<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['logout']);
    }
    public function login(Request $request)
        {
            $request->validate([
                'email' => ["bail", 'required', 'email', 'exists:users,email'],
                'password' => ['required']
            ]);

            try {
                $user = User::where('email', $request->email)->firstOrFail();
                
                // Check if the password is correct
                if (!Hash::check($request->password, $user->password)) {
                    return back()->with('error', 'Invalid credentials');
                }

                // Log the user in
                Auth::login($user);

                // Redirect based on user role
                $location = $user->role === 'admin' ? 'dashboard' : 'home';

                return redirect()->route($location); // Use the variable $location to redirect
            } catch (ModelNotFoundException $e) {
                return back()->with('error', 'Invalid credentials');
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
            'terms' => ['required', 'accepted']
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

            return redirect(route('login'));
        } catch (QueryException $e) {
            return back()->with('error', 'unexpected error occurred');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('landing'));
    }
}
