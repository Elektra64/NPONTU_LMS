<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

// Basic routes
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/signUp', function () {
    return view('signUp');
})->name('signUp');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/courses', function () {
    return view('courses');
})->name('courses');

Route::get('/quizzes', function () {
    return view('quizzes');
})->name('quizzes');

Route::get('/certificateTemplate', function () {
    return view('certificateTemplate');
})->name('certificateTemplate');

Route::get('/users', function () {
    return view('users');
})->name('users');

// Home route with popular courses
Route::get('/home', function () {
    $popularCourses = app(CourseController::class)->getPopularCourses(3);
    return view('home', compact('popularCourses'));
})->name('home');

// Published courses
Route::get('/publishedCourse', function () {
    $courses = app(CourseController::class)->getAllCourses();
    return view('courses.publishedCourse', ['courses' => $courses]);
})->name('courses.publishedCourse');

// Certificate routes
Route::prefix('certificate')->group(function () {
    Route::get('/{enrollmentId}', [EnrollmentController::class, 'showCertificate'])
        ->name('certificate.show');

    Route::get('/{enrollmentId}/download', [EnrollmentController::class, 'generateCertificate'])
        ->name('certificate.download');
});

// Enrollment Routes
Route::controller(EnrollmentController::class)->group(function () {
    // Enrollment flow
    Route::prefix('enroll')->group(function () {
        Route::get('/{courseId}', 'show')->name('enroll.show');
        Route::get('/{courseId}/verify', 'showVerifyPage')->name('enroll.verify');
        Route::post('/{courseId}/verify', 'verify')->name('enroll.verify.submit');
        Route::get('/{courseId}/success', 'success')->name('enroll.success');
        Route::post('/{courseId}/complete', 'complete')->name('enroll.complete');
    });

    // Course completion
    Route::post('/{courseId}/complete', 'completeCourse')->name('course.complete');
    Route::get('/{courseId}/completion', 'completeCourse')->name('course.completion');
});

// Course Content Routes
Route::controller(CourseController::class)->group(function () {
    Route::prefix('course')->group(function () {
        Route::get('/{courseId}/content', 'showCourseContent')->name('course.content');
        Route::get('/{courseId}/section/{section}/lesson/{lesson}', 'showLesson')->name('course.lesson');
    });
});

Route::post('/course/{courseId}/complete', [EnrollmentController::class, 'completeCourse'])
    ->name('course.complete');

// Route::get('/certificate/{enrollmentId}', [EnrollmentController::class, 'showCertificate'])
//     ->name('certificate.show');
