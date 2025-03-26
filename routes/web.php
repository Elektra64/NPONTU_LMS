<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::prefix('admin')->name('admin.')->controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses.index'); // List courses
    Route::get('courses/create', 'create')->name('courses.create'); // Show create form
    Route::post('courses', 'store')->name('courses.store'); // Store a new course
    Route::get('courses/{course}/edit', 'edit')->name('courses.edit'); // Show edit form
    Route::put('courses/{course}', 'update')->name('courses.update'); // Update course
    Route::delete('courses/{course}', 'destroy')->name('courses.destroy'); // Delete course
    Route::get('courses/dashboard', 'dashboard')->name('courses.dashboard'); // Fix dashboard route
});
