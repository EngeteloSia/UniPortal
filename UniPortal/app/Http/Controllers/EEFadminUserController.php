<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EEFadminUserController extends Controller
{

    public function index()
    {
        $users = User::whereIn('role', ['student', 'lecturer'])->get();
        return view('admin.users.index', compact('users'));

    }


    public function create()
    {
        return view('dashboards.admin');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:student,lecturer',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
