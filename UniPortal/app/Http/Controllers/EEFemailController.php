<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EEFuserToUserEmail;


class EEFemailController extends Controller
{
    public function showEmailForm(Request $request)
    {
        // Determine the authenticated user's role
        $role = auth()->user()->role;

        // Determine form action based on user role
        $formAction = $role === 'student'
            ? route('student.email.send')
            : route('lecturer.email.send');

        // Get a list of potential recipients (opposite role only)
        $users = $role === 'student'
            ? \App\Models\User::where('role', 'lecturer')->get()
            : \App\Models\User::where('role', 'student')->get();

        return view('shared.email-form', compact('formAction', 'users'));
    }


    public function sendEmail(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $sender = auth()->user();

        // Send the email using a Mailable class
        Mail::to($request->recipient_email)->send(new EEFuserToUserEmail($sender, $request->subject, $request->message));

        return back()->with('success', 'Email sent successfully!');
    }
}
