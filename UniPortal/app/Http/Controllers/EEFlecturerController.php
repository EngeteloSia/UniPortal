<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class EEFlecturerController extends Controller
{

    public function students()
    {
        $lecturer = Auth::user();


        $students = User::where('role', 'student')->get();


        $courses = $lecturer->courses()->get();

        return view('lecturer.students', compact('students', 'courses'));
    }


    public function enroll(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $lecturer = Auth::user();


        $course = $lecturer->courses()->findOrFail($request->course_id);

        $student = User::findOrFail($request->student_id);


        $student->enrolledCourses()->syncWithoutDetaching([$course->id]);

        return redirect()->back()->with('success', 'Student enrolled successfully.');
    }
}
