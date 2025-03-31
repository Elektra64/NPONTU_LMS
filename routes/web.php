<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;


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

Route::get('/publishedCourse', function () {
    $courses = app(EnrollmentController::class)->getAllCourses();
    return view('courses.publishedCourse', ['courses' => $courses]); // Changed variable name
})->name('courses.publishedCourse');

Route::get('/home', function () {
    $enrollmentController = new EnrollmentController();
    $popularCourses = $enrollmentController->getPopularCourses(3);

    return view('home', ['popularCourses' => $popularCourses]);
});



// Enrollment routes
// Remove duplicate routes and standardize parameter names
Route::controller(EnrollmentController::class)->group(function () {
    Route::get('/enroll/{courseId}', 'show')->name('enroll.show');

    // Split into two separate routes:
    Route::get('/enroll/{courseId}/verify', 'showVerifyPage')->name('enroll.verify'); // GET - Show the page
    Route::post('/enroll/{courseId}/verify', 'verify')->name('enroll.verify.submit'); // POST - Handle form submission

    Route::get('/enroll/{courseId}/complete', 'complete')->name('enroll.complete');
    Route::post('/enroll/{courseId}/process', 'processEnrollment')->name('enroll.process');
    Route::get('/enroll/{courseId}/success', 'success')->name('enroll.success');
});


