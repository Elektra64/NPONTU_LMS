<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;

Route::view('signup', 'signUp')->name('signUp')->middleware('guest');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('home', 'home')->name('home');
Route::view('dashboard', 'dashboard')->name('dashboard');
Route::view('users', 'users')->name('users');
Route::view('quizzes', 'quizzes')->name('quizzes');


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login.post');
    Route::get('logout', 'logout')->name('logout');
    Route::post('/signup', 'register')->name('signUp.post');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses');
    Route::post('create/course', 'create_course')->name('create_course');
});

Route::controller(ModuleController::class)->group(function () {
    Route::post('store/{course}/module', 'store')->name('store.module');
});
