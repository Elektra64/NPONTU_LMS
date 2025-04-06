<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();
        $user = User::find(Auth::user()->id);
        return view('home', compact('courses', 'user'));
    }
}
