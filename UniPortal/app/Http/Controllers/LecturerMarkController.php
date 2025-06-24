<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Mark;
use Illuminate\Http\Request;

class LecturerMarkController extends Controller
{
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();

        return view('lecturer.marks.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'assessment_type' => 'required|string',
            'mark' => 'required|numeric|min:0|max:100',
        ]);

        Mark::create($request->only('student_id', 'course_id', 'assessment_type', 'mark'));

        return redirect()->route('lecturer.marks.create')->with('success', 'Mark recorded successfully!');
    }
}

