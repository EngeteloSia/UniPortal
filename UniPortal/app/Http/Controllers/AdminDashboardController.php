<?php  

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'students' => User::where('role', 'student')->get(),
            'lecturers' => User::where('role', 'lecturer')->get(),
            'courses' => Course::all(),
        ]);
    }
}
