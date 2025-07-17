<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FEEDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FEEStudentDashboardController;
use App\Http\Controllers\FEELecturerDashboardController;
use App\Http\Controllers\FEELecturerController;
use App\Http\Controllers\FEELecturerCourseController;
use App\Http\Controllers\FEEEnrollmentController;
use App\Http\Controllers\FEEAdminDashboardController;
use App\Http\Controllers\FEEAdminUserController;
use App\Http\Controllers\FEEAdminCourseController;

Route::get('/', function () {
    return view('welcome');
});

// General dashboard (optional - used for shared views)
Route::get('/dashboard', [FEEDashboardController::class, 'index'])
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
    Route::get('/student/dashboard', [FEEStudentDashboardController::class, 'index'])->name('student.dashboard');
});

Route::post('/courses/{course}/enroll', [FEEEnrollmentController::class, 'enroll'])->name('courses.enroll');

// Lecturer-only dashboard
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [FEELecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
});

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/students', [App\Http\Controllers\FEELecturerController::class, 'students'])->name('lecturer.students');
    Route::post('/lecturer/enroll', [App\Http\Controllers\FEELecturerController::class, 'enroll'])->name('lecturer.enroll');
});




// Lecturer dashboard + course management
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [FEELecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
    Route::get('/lecturer/students', [FEELecturerController::class, 'students'])->name('lecturer.students');
    Route::post('/lecturer/enroll', [FEELecturerController::class, 'enroll'])->name('lecturer.enroll');
});


Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::post('/lecturer/courses', [FEELecturerCourseController::class, 'store'])->name('lecturer.courses.store');
});



Route::post('/enroll', [FEEEnrollmentController::class, 'enroll'])->name('enroll');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [FEEAdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', FEEAdminUserController::class);
    Route::resource('/courses', FEEAdminCourseController::class);
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/progress-report', [FEEStudentDashboardController::class, 'progressReport'])->name('student.progress.report');
});

use App\Http\Controllers\FEELecturerMarkController;

Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/marks/create', [FEELecturerMarkController::class, 'create'])->name('marks.create');
    Route::post('/marks', [FEELecturerMarkController::class, 'store'])->name('marks.store');
});

use App\Http\Controllers\Api\FEECourseModuleController;

Route::get('/courses/{course}/modules', [FEECourseModuleController::class, 'index']);

use App\Http\Controllers\FEEModuleController;


Route::middleware('auth')->get('/courses/{course}/modules', [FEEModuleController::class, 'getByCourse']);

Route::get('/student/progress-report', [FEEStudentDashboardController::class, 'progressReport'])->name('student.progress-report');
// API routes for moduels 
Route::get('/courses/{course}/modules', [\App\Http\Controllers\FEEModuleController::class, 'getByCourse'])->name('courses.modules');
//PDF download route
Route::get('/student/progress-report/pdf', [\App\Http\Controllers\FEEStudentDashboardController::class, 'progressReportPdf'])->name('student.progress-report.pdf');

use App\Http\Controllers\FEEEmailController;

Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::get('/student/email', [FEEEmailController::class, 'showEmailForm'])->name('student.email.form');
    Route::post('/student/email/send', [FEEEmailController::class, 'sendEmail'])->name('student.email.send');
});

Route::middleware(['auth', 'verified', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/email', [FEEEmailController::class, 'showEmailForm'])->name('lecturer.email.form');
    Route::post('/lecturer/email/send', [FEEEmailController::class, 'sendEmail'])->name('lecturer.email.send');
});

require __DIR__ . '/auth.php';
