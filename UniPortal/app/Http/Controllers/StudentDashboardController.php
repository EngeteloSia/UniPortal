<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function progressReport()
    {
        $student = Auth::user();
        $marks = $student->marks()->with('course')->get();

        return view('students.progress-report', compact('marks'));
    }
}
