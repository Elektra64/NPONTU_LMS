<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/signUp', function () {
    return view('signUp');
})->name('signUp');

Route::post('/signUp', [AuthController::class, 'register'])->name('signUp.post');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/courses', function () {
    return view('courses');
})->name('courses');

Route::get('/quizzes', function () {
    return view('quizzes');
})->name('quizzes');

Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/home', function () {
    return view('home');
})->name('home');