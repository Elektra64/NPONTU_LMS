<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;



Route::view('home', 'home')->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'landing')->name('landing');
    Route::view('register', 'register')->name('register');
    Route::view('login', 'login')->name('login');
});

Route::view('dashboard', 'dashboard')->name('dashboard')->middleware('auth');
Route::view('users', 'users')->name('users')->middleware('auth');


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login.post');
    Route::get('logout', 'logout')->name('logout');
    Route::post('/signup', 'register')->name('signUp.post');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses');
    Route::get('published/courses', 'published_courses')->name('published.courses');
    Route::post('create/course', 'create_course')->name('create_course');
});

Route::controller(ModuleController::class)->group(function () {
    Route::post('store/{course}/module', 'store')->name('store.module');
});
