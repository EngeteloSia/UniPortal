<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;


use Illuminate\Http\Request;

class FEELecturerDashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $lecturer */
        $lecturer = Auth::user();

        // Get courses taught by this lecturer
        $courses = $lecturer->courses()->with('students')->get();

        // Get all students for enrollment dropdown
        $students = \App\Models\User::where('role', 'student')->get();

        return view('dashboard', compact('courses', 'students'));
    }
}
