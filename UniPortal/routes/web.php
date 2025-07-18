<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EEFdashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FEEStudentDashboardController;
use App\Http\Controllers\EEFlecturerDashboardController;
use App\Http\Controllers\EEFlecturerController;
use App\Http\Controllers\EEFlecturerCourseController;
use App\Http\Controllers\EEFenrollmentController;
use App\Http\Controllers\EEFadminDashboardController;
use App\Http\Controllers\EEFadminUserController;
use App\Http\Controllers\EEFadminCourseController;

Route::get('/', function () {
    return view('welcome');
});

// General dashboard (optional - used for shared views)
Route::get('/dashboard', [EEFdashboardController::class, 'index'])
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

Route::post('/courses/{Course}/enroll', [EEFenrollmentController::class, 'enroll'])->name('courses.enroll');

// Lecturer-only dashboard
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [EEFlecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
});

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/students', [App\Http\Controllers\EEFlecturerController::class, 'students'])->name('lecturer.students');
    Route::post('/lecturer/enroll', [App\Http\Controllers\EEFlecturerController::class, 'enroll'])->name('lecturer.enroll');
});




// Lecturer dashboard + Course management
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [EEFlecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
    Route::get('/lecturer/students', [EEFlecturerController::class, 'students'])->name('lecturer.students');
    Route::post('/lecturer/enroll', [EEFlecturerController::class, 'enroll'])->name('lecturer.enroll');
});


Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::post('/lecturer/courses', [EEFlecturerCourseController::class, 'store'])->name('lecturer.courses.store');
});



Route::post('/enroll', [EEFenrollmentController::class, 'enroll'])->name('enroll');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [EEFadminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', EEFadminUserController::class);
    Route::resource('/courses', EEFadminCourseController::class);
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/progress-report', [FEEStudentDashboardController::class, 'progressReport'])->name('student.progress.report');
});

use App\Http\Controllers\EEFlecturerMarkController;

Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/marks/create', [EEFlecturerMarkController::class, 'create'])->name('marks.create');
    Route::post('/marks', [EEFlecturerMarkController::class, 'store'])->name('marks.store');
});

use App\Http\Controllers\Api\EEFcourseModuleController;

Route::get('/courses/{Course}/modules', [EEFcourseModuleController::class, 'index']);

use App\Http\Controllers\EEFmoduleController;


Route::middleware('auth')->get('/courses/{Course}/modules', [EEFmoduleController::class, 'getByCourse']);

Route::get('/student/progress-report', [FEEStudentDashboardController::class, 'progressReport'])->name('student.progress-report');
// API routes for moduels
Route::get('/courses/{Course}/modules', [\App\Http\Controllers\EEFmoduleController::class, 'getByCourse'])->name('courses.modules');
//PDF download route
Route::get('/student/progress-report/pdf', [\App\Http\Controllers\FEEStudentDashboardController::class, 'progressReportPdf'])->name('student.progress-report.pdf');

use App\Http\Controllers\EEFemailController;

Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::get('/student/email', [EEFemailController::class, 'showEmailForm'])->name('student.email.form');
    Route::post('/student/email/send', [EEFemailController::class, 'sendEmail'])->name('student.email.send');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/email', [EEFemailController::class, 'showEmailForm'])->name('email.form');
    Route::post('/email/send/student', [EEFemailController::class, 'sendEmail'])->name('student.email.send');
    Route::post('/email/send/lecturer', [EEFemailController::class, 'sendEmail'])->name('lecturer.email.send');
});


Route::middleware(['auth', 'verified', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/email', [EEFemailController::class, 'showEmailForm'])->name('lecturer.email.form');
    Route::post('/lecturer/email/send', [EEFemailController::class, 'sendEmail'])->name('lecturer.email.send');
});

require __DIR__ . '/auth.php';
