<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class LecturerCourseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'modules' => 'array|max:10',
            'modules.*.title' => 'nullable|string|max:255',
            'modules.*.description' => 'nullable|string|max:1000',
        ]);

        $lecturer = Auth::user();

        // Create the course
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->lecturer_id = $lecturer->id;
        $course->save();

        // Save modules if provided
        if ($request->filled('modules')) {
            foreach ($request->modules as $moduleData) {
                // Only save modules with a title (ignore empty)
                if (!empty($moduleData['title'])) {
                    $course->modules()->create([
                        'title' => $moduleData['title'],
                        'description' => $moduleData['description'] ?? '',
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Course created successfully.');
    }
}
