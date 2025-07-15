<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class StudentDashboardController extends Controller
{
    public function index()
    {
       $student = Auth::user();

    $courses = $student->enrolledCourses()->with('modules')->get()->unique('id');
    $marks = $student->marks()->with(['course', 'module'])->get();
    $enrolledIds = $courses->pluck('id');
    $availableCourses = \App\Models\Course::whereNotIn('id', $enrolledIds)->get();

    // Return the correct view!
    return view('dashboards.student', compact('courses', 'marks', 'availableCourses'));
    }

    public function progressReport()
    {
        $student = Auth::user(); // current logged-in student

        // Get marks with course info for progress report
        $marks = $student->marks()->with('course')->get();

        return view('students.progress-report', compact('marks'));
    }
}