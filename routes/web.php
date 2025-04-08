<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;


Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::group(['middleware' => 'guest'], function () {
    Route::view('register', 'register')->name('register');
    Route::view('/', 'landing')->name('landing');
    Route::view('login', 'login')->name('login');
});

Route::view('users', 'users')->name('users')->middleware('auth');

Route::controller(DashboardController::class)->prefix('admin')->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('logout');
    Route::post('/register', 'register');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses');
    Route::get('published/courses', 'show_published_courses')->name('published.courses');
    Route::post('create/course', 'create_course')->name('create_course');
    Route::get('delete/course/{course}', 'delete_course')->name('delete_course');
    Route::get('course/{course}', 'course_details')->name('course_details');
    Route::get('course/content/{course}', 'enrolled_course_content')->name('enrolled_course_content');
    Route::get('course/content/{course}/{module}/next', 'next_module')->name('next_module');
    Route::get('course/content/{course}/{module}/previous', 'previous_module')->name('previous_module');
});

Route::controller(ModuleController::class)->group(function () {
    Route::post('store/{course}/module', 'store')->name('store_module');
    Route::get('delete/module/{module}', 'delete')->name('delete_module');
});

Route::controller(EnrollmentController::class)->group(function () {
    Route::get('verify/enrollment/{course}', 'show')->name('verfiy_enrollment');
    Route::post('verify/enrollment/{course}', 'verify');
    Route::get('enroll/{course}', 'enroll')->name('enroll');
    Route::post('enroll/{course}', 'validate_enrollment');
    Route::post('submit/quiz/{quizQuestion}/{enrollment}', 'submit_quiz')->name('submit_quiz');
});

// routes/web.php
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/active-users', [UserController::class, 'getUsers']);