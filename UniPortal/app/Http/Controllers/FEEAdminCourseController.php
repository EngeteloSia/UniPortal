<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class FEEAdminCourseController extends Controller
{
    // List all courses
    public function index()
    {
        $courses = Course::with('lecturer')->get();
        return view('admin.courses.index', compact('courses'));
    }

    // Show form to create a new course
    public function create()
    {
        return view('admin.courses.create');
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'lecturer_id' => 'nullable|exists:users,id',
        ]);

        Course::create($request->only('title', 'description', 'lecturer_id'));

        return redirect()->route('admin.courses.index')->with('success', 'Course created.');
    }

    // Delete a course
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted.');
    }
}
