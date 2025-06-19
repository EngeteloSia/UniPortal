<?php

use App\Http\Controllers\LecturerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// General dashboard (optional - used for shared views)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated user profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Student-only dashboard
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

// Lecturer-only dashboard
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [LecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
});

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/students', [App\Http\Controllers\LecturerController::class, 'students'])->name('lecturer.students');
    Route::post('/lecturer/enroll', [App\Http\Controllers\LecturerController::class, 'enroll'])->name('lecturer.enroll');
});

use App\Http\Controllers\LecturerController;


// Lecturer dashboard + course management
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [LecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
    Route::get('/lecturer/students', [LecturerController::class, 'students'])->name('lecturer.students');
    Route::post('/lecturer/enroll', [LecturerController::class, 'enroll'])->name('lecturer.enroll');
});
use App\Http\Controllers\LecturerCourseController;

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::post('/lecturer/courses', [LecturerCourseController::class, 'store'])->name('lecturer.courses.store');
});

use App\Http\Controllers\EnrollmentController;

Route::post('/enroll', [EnrollmentController::class, 'enroll'])->name('enroll');


require __DIR__.'/auth.php';

