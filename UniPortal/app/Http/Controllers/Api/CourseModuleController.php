<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseModuleController extends Controller
{
    public function index(Course $course)
    {
        return $course->modules()->select('id', 'title')->get();
    }
}
