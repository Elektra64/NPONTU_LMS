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
                return response()->json(["apiToken" => null]);
            }
            $userToken = $user->createToken($user->username);
            return response()->json(['apiToken' => $userToken->plainTextToken]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['apiToken' => null]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
            'username' => ['required', 'max:255', 'unique:users,username'],
            'role' => ['required', Rule::in(['admin', 'learner'])],
            'firstName' => ['required'],
            'lastName' => ['required'],
        ]);

        try {
            $user = User::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'username' => $request->username,
                'role' => $request->role,
                'password' => Hash::make($request->password)
            ]);
            $userToken = $user->createToken($user->username);
            return response()->json(['apiToken' => $userToken->plainTextToken]);
        } catch (QueryException $e) {
            return response()->json(['apiToken' => null]);
        }
    }
}
