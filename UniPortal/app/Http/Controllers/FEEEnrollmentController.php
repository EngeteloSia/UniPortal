<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FEEEnrollmentController extends Controller
{
    public function enroll(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Find student and enroll
        $student = User::findOrFail($request->student_id);

        // Attach course
        $student->enrolledCourses()->attach($request->course_id);

        return redirect()->back()->with('success', 'Student enrolled successfully!');
    }
}
