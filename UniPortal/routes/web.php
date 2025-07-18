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
use App\Http\Controllers\EEFlecturerMarkController;
use App\Http\Controllers\EEFmoduleController;
use App\Http\Controllers\EEFemailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public welcome page
Route::get('/', function () {
    return view('welcome');
});

// Authenticated dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [EEFdashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student routes
    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', [FEEStudentDashboardController::class, 'index'])->name('student.dashboard');
        Route::get('/student/progress-report', [FEEStudentDashboardController::class, 'progressReport'])->name('student.progress.report');
        Route::get('/student/progress-report/pdf', [FEEStudentDashboardController::class, 'progressReportPdf'])->name('student.progress-report.pdf');

        Route::middleware('verified')->group(function () {
            Route::get('/student/email', [EEFemailController::class, 'showEmailForm'])->name('student.email.form');
            Route::post('/student/email/send', [EEFemailController::class, 'sendEmail'])->name('student.email.send');
        });
    });

    // Lecturer routes
    Route::middleware('role:lecturer')->group(function () {
        Route::get('/lecturer/dashboard', [EEFlecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
        Route::get('/lecturer/students', [EEFlecturerController::class, 'students'])->name('lecturer.students');
        Route::post('/lecturer/enroll', [EEFlecturerController::class, 'enroll'])->name('lecturer.enroll');
        Route::post('/lecturer/courses', [EEFlecturerCourseController::class, 'store'])->name('lecturer.courses.store');

        Route::get('/lecturer/marks/create', [EEFlecturerMarkController::class, 'create'])->name('marks.create');
        Route::post('/lecturer/marks', [EEFlecturerMarkController::class, 'store'])->name('marks.store');

        Route::middleware('verified')->group(function () {
            Route::get('/lecturer/email', [EEFemailController::class, 'showEmailForm'])->name('lecturer.email.form');
            Route::post('/lecturer/email/send', [EEFemailController::class, 'sendEmail'])->name('lecturer.email.send');
        });
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [EEFadminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/users', EEFadminUserController::class);
        Route::resource('/courses', EEFadminCourseController::class);
    });

    // Email inbox route accessible to all authenticated users
    Route::get('/inbox', [EEFemailController::class, 'inbox'])->name('email.inbox');
});

// Enrollment routes (some outside role groups for flexibility)
Route::post('/courses/{course}/enroll', [EEFenrollmentController::class, 'enroll'])->name('courses.enroll');
Route::post('/enroll', [EEFenrollmentController::class, 'enroll'])->name('enroll');

// Email routes accessible to authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/email', [EEFemailController::class, 'showEmailForm'])->name('email.form');
    Route::post('/email/send/student', [EEFemailController::class, 'sendEmail'])->name('student.email.send');
    Route::post('/email/send/lecturer', [EEFemailController::class, 'sendEmail'])->name('lecturer.email.send');
    Route::get('/email/{id}', [EEFemailController::class, 'show'])->name('email.show');
});

// ====== Your key route: fetch modules by course (only one, with auth) ======
Route::middleware('auth')->get('/courses/{course}/modules', [EEFmoduleController::class, 'getByCourse'])->name('courses.modules');
Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/marks/create', [EEFlecturerMarkController::class, 'create'])->name('marks.create');
    Route::post('/marks', [EEFlecturerMarkController::class, 'store'])->name('marks.store'); // <-- this is missing
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/progress-report', [FEEStudentDashboardController::class, 'progressReport'])->name('student.progress-report');
});



Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/courses/{course}/enroll', [EEFenrollmentController::class, 'enroll'])->name('courses.enroll');
});

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/enrollments/pending', [EEFenrollmentController::class, 'pendingEnrollments'])->name('lecturer.enrollments.pending');
    Route::post('/lecturer/enrollments/{id}/accept', [EEFenrollmentController::class, 'acceptEnrollment'])->name('lecturer.enrollments.accept');
    Route::post('/lecturer/enrollments/{id}/reject', [EEfenrollmentController::class, 'rejectEnrollment'])->name('lecturer.enrollments.reject');
});

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/enrollments', [App\Http\Controllers\EEFlecturerController::class, 'enrollmentRequests'])->name('lecturer.enrollments');
});
Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::patch('/lecturer/enrollments/{id}', [App\Http\Controllers\EEFlecturerController::class, 'updateEnrollmentStatus'])->name('lecturer.enrollments.update');
});


// Auth routes from Laravel Breeze / Jetstream etc.
require __DIR__ . '/auth.php';
