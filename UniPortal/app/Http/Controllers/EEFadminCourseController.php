<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class EEFadminCourseController extends Controller
{
    
    public function index()
    {
        $courses = Course::with('lecturer')->get();
        return view('admin.courses.index', compact('courses'));
    }

    
    public function create()
    {
        return view('admin.courses.create');
    }

    
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

   
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted.');
    }
}
