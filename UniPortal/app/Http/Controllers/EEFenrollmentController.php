<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\Auth;

class EEFenrollmentController extends Controller
{
    // Student requests enrollment - creates pending request
    public function enroll(Request $request, Course $course)
{
    $studentId = Auth::id();

    // Get the course ID from the route parameter
    $courseId = $course->id;

    // Check if enrollment request already exists
    $exists = CourseEnrollment::where('student_id', $studentId)
        ->where('course_id', $courseId)
        ->exists();

    if ($exists) {
        return back()->with('message', 'You have already requested enrollment for this course.');
    }

    CourseEnrollment::create([
        'student_id' => $studentId,
        'course_id' => $courseId,
        'status' => 'pending',
    ]);

    return back()->with('message', 'Enrollment request sent. Please wait for lecturer approval.');
}

    // Lecturer views all pending enrollment requests
    public function pendingEnrollments()
    {
        $lecturerId = Auth::id();

        $courses = Course::where('lecturer_id', $lecturerId)->pluck('id')->toArray();

        $pendingRequests = CourseEnrollment::with('student', 'course')
            ->whereIn('course_id', $courses)
            ->where('status', 'pending')
            ->get();

        return view('lecturer.enrollments.pending', compact('pendingRequests'));
    }

    // Lecturer accepts enrollment request
    public function acceptEnrollment($id)
    {
        $enrollment = CourseEnrollment::findOrFail($id);

        // Authorization check: only lecturer who owns the course can accept
        if ($enrollment->course->lecturer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $enrollment->update(['status' => 'accepted']);

        // Also add student to course_student pivot table for actual enrollment
        $enrollment->student->enrolledCourses()->attach($enrollment->course_id);

        return back()->with('message', 'Enrollment accepted.');
    }

    // Lecturer rejects enrollment request
    public function rejectEnrollment($id)
    {
        $enrollment = CourseEnrollment::findOrFail($id);

        // Authorization check: only lecturer who owns the course can reject
        if ($enrollment->course->lecturer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $enrollment->update(['status' => 'rejected']);

        return back()->with('message', 'Enrollment rejected.');
    }
    

public function updateEnrollmentStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:accepted,rejected',
    ]);

    $enrollment = CourseEnrollment::findOrFail($id);

    // Make sure this enrollment belongs to a course the logged-in lecturer owns
    if ($enrollment->course->lecturer_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $enrollment->status = $request->status;
    $enrollment->save();

    return redirect()->route('lecturer.enrollments')->with('message', 'Enrollment status updated.');
}

}
