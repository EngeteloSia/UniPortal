<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;

class FEEStudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        $courses = $student->enrolledCourses()->with('modules')->get()->unique('id');
        $marks = $student->marks()->with(['Course', 'module'])->get();
        $enrolledIds = $courses->pluck('id');
        $availableCourses = \App\Models\Course::whereNotIn('id', $enrolledIds)->get();

        // Return the correct view!
        return view('dashboards.student', compact('courses', 'marks', 'availableCourses'));
    }

    public function progressReport()
    {
        $student = Auth::user();
        $courses = $student->enrolledCourses()->with(['modules', 'modules.marks' => function ($query) use ($student) {
            $query->where('student_id', $student->id);
        }])->get();

        return view('students.progress-report', compact('courses', 'student'));
    }

    public function progressReportPdf()
{
    $student = Auth::user();
    $courses = $student->enrolledCourses()->with(['modules', 'modules.marks' => function($query) use ($student) {
        $query->where('student_id', $student->id);
    }])->get();

    $pdf = Pdf::loadView('students.progress-report-pdf', compact('courses', 'student'));
    return $pdf->download('progress-report.pdf');
}
}
