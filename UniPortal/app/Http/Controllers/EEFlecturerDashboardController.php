<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;


use Illuminate\Http\Request;

class EEFlecturerDashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $lecturer */
        $lecturer = Auth::user();


        $courses = $lecturer->courses()->with('students')->get();


        $students = \App\Models\User::where('role', 'student')->get();

        return view('dashboard', compact('courses', 'students'));
    }
}
