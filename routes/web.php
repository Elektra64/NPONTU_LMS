<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;



Route::view('home', 'home')->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::view('/', 'landing')->name('landing');
    Route::view('register', 'register')->name('register');
    Route::view('login', 'login')->name('login');
});

Route::view('users', 'users')->name('users')->middleware('auth');

Route::controller(DashboardController::class)->prefix('admin')->group(function () {
    Route::get('dashboard', 'index')->name('dashboard')->middleware('auth');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('logout');
    Route::post('/register', 'register');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses');
    Route::get('published/courses', 'published_courses')->name('published.courses');
    Route::post('create/course', 'create_course')->name('create_course');
    Route::get('delete/course/{course}', 'delete_course')->name('delete_course');
    Route::get('course/{course}', 'course_details')->name('course_details');
});

Route::controller(ModuleController::class)->group(function () {
    Route::post('store/{course}/module', 'store')->name('store_module');
    Route::get('delete/module/{module}', 'delete')->name('delete_module');
});
