<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user(); // current logged-in user (student)

        // Get enrolled courses with modules, ensuring uniqueness
        $courses = $student->enrolledCourses()->with('modules')->get()->unique('id');

        // Get marks with related course and module info
        $marks = $student->marks()->with(['course', 'module'])->get();

        return view('dashboard', compact('courses', 'marks'));
    }

    public function progressReport()
    {
        $student = Auth::user(); // current logged-in student

        // Get marks with course info for progress report
        $marks = $student->marks()->with('course')->get();

        return view('students.progress-report', compact('marks'));
    }
}
