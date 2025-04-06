<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        $user = User::find(Auth::user()->id);
        $courses = $user->courses()->latest()->with(['modules', 'user', 'categories'])->get();
        return view('dashboard', compact('courses', 'user'));
    }
}
