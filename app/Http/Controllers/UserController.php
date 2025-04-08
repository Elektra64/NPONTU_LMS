<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        // Debugging: Check if users are fetched
        // \Log::info('Fetched users:', $users->toArray()); // Log the users to the log file

        return view('users', compact('users')); // Pass users to the view
    }

    // public function getUsers()
    // {
    //     // Fetch the total count of all users
    //     $totalUsersCount = User::count();

    //     // Pass the count to the view
    //     return view('dashboard', compact('totalUsersCount'));
    // }
}