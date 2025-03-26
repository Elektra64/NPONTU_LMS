<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/register', function () {
    return view('signUp');
})->name('signUp');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/courses', function () {
    return view('courses');
})->name('courses');

Route::get('/home', function () {
    return view('home');
})->name('home');
