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

Route::get('/publishedCourse', function () {
    return view('courses.publishedCourse');
})->name('courses.publishedCourse');




    ///enroll/${course.id} define this route for the course
    // In routes/web.php
Route::get('/enroll/{id}', [App\Http\Controllers\EnrollmentController::class, 'show'])
->name('enroll');

use App\Http\Controllers\EnrollmentController;

Route::post('/enroll/{id}/verify', [EnrollmentController::class, 'verify'])
     ->name('enroll.verify');

// Enrollment routes
// Remove duplicate routes and standardize parameter names
Route::controller(EnrollmentController::class)->group(function () {
    Route::get('/enroll/{courseId}', 'show')->name('enroll.show');
    Route::post('/enroll/{courseId}/verify', 'verify')->name('enroll.verify');
    Route::get('/enroll/{courseId}/complete', 'complete')->name('enroll.complete');
    Route::post('/enroll/{courseId}/process', 'processEnrollment')->name('enroll.process');
    Route::get('/enroll/{courseId}/success', 'success')->name('enroll.success');
});


// routes/web.php testing purposes only
Route::get('/test-mock/{id}', function($id) {
    $mockCourses = [
        1 => [
            'id' => 1,
            'title' => 'Web Development Bootcamp',
            // ... other fields
        ],
        2 => [
            'id' => 2,
            'title' => 'Graphic Design Masterclass',
            // ... other fields
        ]
    ];

    return response()->json($mockCourses[$id] ?? [
        'id' => $id,
        'title' => 'Sample Course',
        'description' => 'Default course'
    ]);
});

Route::get('/test-mock/__ALL__', function() {
    return response()->json([
        1 => 'Web Development Bootcamp',
        2 => 'Graphic Design Masterclass'
    ]);
});
