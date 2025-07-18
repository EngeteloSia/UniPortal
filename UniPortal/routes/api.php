<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FEECourseModuleController;

Route::get('/courses/{Course}/modules', [FEECourseModuleController::class, 'index']);

Route::get('/test', function () {
    return ['message' => 'API is working'];});
