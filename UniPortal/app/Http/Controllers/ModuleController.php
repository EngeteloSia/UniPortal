<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function getByCourse(Course $course)
    {
        
        $modules = $course->modules()->select('id', 'title')->get();

       
        return response()->json($modules);
    }
}
