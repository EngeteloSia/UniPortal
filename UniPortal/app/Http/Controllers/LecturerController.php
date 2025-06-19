<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;

class LecturerController extends Controller
{
    // Show list of students with courses to enroll
    public function students()
    {
        $lecturer = Auth::user();

        // Get all students
        $students = User::where('role', 'student')->get();

        // Get courses this lecturer teaches
        $courses = $lecturer->courses()->get();

        return view('lecturer.students', compact('students', 'courses'));
    }

    // Enroll a student in a course
    public function enroll(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $lecturer = Auth::user();

        // Ensure the course belongs to this lecturer
        $course = $lecturer->courses()->findOrFail($request->course_id);

        $student = User::findOrFail($request->student_id);

        // Attach student to course without detaching existing
        $student->enrolledCourses()->syncWithoutDetaching([$course->id]);

        return redirect()->back()->with('success', 'Student enrolled successfully.');
    }
}
