<?php  

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
{
    $admin = Auth::user();
    $users = User::all(); // ✅ outside the array

    return view('dashboards.admin', [
        'admin' => $admin,
        'students' => User::where('role', 'student')->get(),
        'lecturers' => User::where('role', 'lecturer')->get(),
        'courses' => Course::all(),
        'users' => $users, // ✅ Now it's valid
    ]);
}
}
