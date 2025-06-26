<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseModuleController;

Route::get('/courses/{course}/modules', [CourseModuleController::class, 'index']);

Route::get('/test', function () {
    return ['message' => 'API is working'];});