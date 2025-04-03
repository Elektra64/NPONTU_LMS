<?php

use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

// Basic routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); // Add ->name() to reference it later

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

Route::get('/users', function () {
    return view('users');
})->name('users');

// Route::get('/home', function () {
//     return view('home');
// })->name('home');

// Certificate routes
Route::get('/courses/certificate', function () {
    return view('courses.certificate');
})->name('courses.certificate');

Route::get('/publishedCourse', function () {
    $courses = app(EnrollmentController::class)->getAllCourses();
    return view('courses.publishedCourse', ['courses' => $courses]);
})->name('courses.publishedCourse');

// // Enrollment routes
// Route::controller(EnrollmentController::class)->group(function () {
//     // Show enrollment page
//     Route::get('/enroll/{courseId}', 'show')->name('enroll.show');

    return view('home', ['popularCourses' => $popularCourses]);
})->name('home');


//     // Completion routes
//     Route::get('/enroll/{courseId}/complete', 'complete')->name('enroll.complete');
//     Route::post('/enroll/{courseId}/process', 'processEnrollment')->name('enroll.process');

//     // Success route
//     Route::get('/enroll/{courseId}/success', 'success')->name('enroll.success');
// });

Route::controller(EnrollmentController::class)->group(function () {
    // Show enrollment page
    Route::get('/enroll/{courseId}', 'show')->name('enroll.show');

    // Verification
    Route::get('/enroll/{courseId}/verify', 'showVerifyPage')->name('enroll.verify.show');
    Route::post('/enroll/{courseId}/verify', 'verify')->name('enroll.verify.submit');

    // Completion
    Route::get('/enroll/{courseId}/complete', 'complete')->name('enroll.complete');
    Route::post('/enroll/{courseId}/complete', 'completeEnrollment')->name('enroll.complete.submit');

    // Success
    Route::get('/enroll/{courseId}/success', 'success')->name('enroll.success');
    Route::get('/enroll/{courseId}/courseContent', 'showContent')->name('enroll.courseContent');
});
