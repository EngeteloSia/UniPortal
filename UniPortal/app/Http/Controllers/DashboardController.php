<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            // Fetch courses the student is enrolled in, with modules
            $courses = $user->enrolledCourses()->with('modules')->get();

            return view('dashboards.student', compact('courses'));
        } elseif ($user->role === 'lecturer') {
            // Fetch courses taught by the lecturer
            $courses = Course::where('lecturer_id', $user->id)
                ->with('students')
                ->get();

            // Get all users with role 'student' (for enrollment form)
            $students = User::where('role', 'student')->get();

            return view('dashboards.lecturer', compact('courses', 'students'));
        } else {
            return view('dashboard'); // default/fallback
        }
    }
}
