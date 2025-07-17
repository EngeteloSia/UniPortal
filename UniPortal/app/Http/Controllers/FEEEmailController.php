<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserToUserEmail;


class FEEEmailController extends Controller
{
    public function showEmailForm(Request $request)
    {
        // Optionally pre-fill recipient email if passed as query param
        $recipientEmail = $request->query('to', '');

        // Determine form action based on role (student or lecturer)
        $role = auth()->user()->role;
        $formAction = $role === 'student' 
            ? route('student.email.send') 
            : route('lecturer.email.send');

        return view('shared.email-form', compact('formAction', 'recipientEmail'));
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
        Mail::to($request->recipient_email)->send(new UserToUserEmail($sender, $request->subject, $request->message));

        return back()->with('success', 'Email sent successfully!');
    }
}
