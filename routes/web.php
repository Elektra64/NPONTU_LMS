<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/signUp', function () {
    return view('signUp');
});

Route::get('/login', function () {
    return view('login');
})->name('login');



Route::get('/signUp', function () {
    return view('signUp');
})->name('signUp');

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
