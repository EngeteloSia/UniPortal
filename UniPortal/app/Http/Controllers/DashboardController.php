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

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
            $courses = $user->enrolledCourses()->with('modules')->get();
            $marks = $user->marks()->with('course')->get(); // ✅ Now safe to access

            return view('dashboards.student', compact('courses', 'marks'));
        } elseif ($user->role === 'lecturer') {
            $courses = Course::where('lecturer_id', $user->id)->with('students')->get();
            $students = User::where('role', 'student')->get();

            return view('dashboards.lecturer', compact('courses', 'students'));
        } else {
            abort(403, 'Unauthorized access');
        }
    }
}
