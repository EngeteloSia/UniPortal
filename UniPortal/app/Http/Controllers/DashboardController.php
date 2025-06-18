<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            return view('dashboards.student');
        } elseif ($user->role === 'lecturer') {
            return view('dashboards.lecturer');
        } else {
            return view('dashboard'); // default
        }
    }
}
