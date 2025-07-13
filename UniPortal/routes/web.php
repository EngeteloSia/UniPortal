<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\LecturerDashboardController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerCourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCourseController;
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




// Lecturer dashboard + course management
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [LecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
    Route::get('/lecturer/students', [LecturerController::class, 'students'])->name('lecturer.students');
    Route::post('/lecturer/enroll', [LecturerController::class, 'enroll'])->name('lecturer.enroll');
});


Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::post('/lecturer/courses', [LecturerCourseController::class, 'store'])->name('lecturer.courses.store');
});



Route::post('/enroll', [EnrollmentController::class, 'enroll'])->name('enroll');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', AdminUserController::class);
    Route::resource('/courses', AdminCourseController::class);
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/progress-report', [StudentDashboardController::class, 'progressReport'])->name('student.progress.report');
});

use App\Http\Controllers\LecturerMarkController;

Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/marks/create', [LecturerMarkController::class, 'create'])->name('marks.create');
    Route::post('/marks', [LecturerMarkController::class, 'store'])->name('marks.store');
});

use App\Http\Controllers\Api\CourseModuleController;

Route::get('/courses/{course}/modules', [CourseModuleController::class, 'index']);

use App\Http\Controllers\ModuleController;

Route::middleware('auth')->get('/courses/{course}/modules', [ModuleController::class, 'getByCourse']);



Route::get('/courses/{course}/modules', [\App\Http\Controllers\ModuleController::class, 'getByCourse'])->name('courses.modules');

require __DIR__.'/auth.php';

