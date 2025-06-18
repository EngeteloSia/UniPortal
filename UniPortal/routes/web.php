<?php

use App\Http\Controllers\LecturerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [LecturerDashboardController::class, 'index'])->name('lecturer.dashboard');
});

Route::middleware(['auth', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [LecturerDashboardController::class, 'index'])
        ->name('lecturer.dashboard');
});
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
        ->name('student.dashboard');
});

require __DIR__.'/auth.php';
