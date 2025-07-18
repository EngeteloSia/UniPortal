<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EEFenrollmentController extends Controller
{
    public function enroll(Request $request)
    {

        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);


        $student = User::findOrFail($request->student_id);


        $student->enrolledCourses()->attach($request->course_id);

        return redirect()->back()->with('success', 'Student enrolled successfully!');
    }
}
