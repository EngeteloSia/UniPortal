<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FEEStudentContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'lecturer_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::raw($validated['message'], function ($mail) use ($validated, $request) {
            $mail->to($validated['lecturer_email'])
                 ->subject($validated['subject'])
                 ->from(auth()->user()->email, auth()->user()->name);
        });

        return redirect()->back()->with('success', 'Email sent to lecturer.');
    }
}
