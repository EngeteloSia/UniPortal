<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EEFuserToUserEmail;
use App\Models\FMessage;
use App\Models\User;


class EEFemailController extends Controller
{
    public function showEmailForm(Request $request)
    {
        
        $role = auth()->user()->role;

        
        $formAction = $role === 'student'
            ? route('student.email.send')
            : route('lecturer.email.send');

     
        $users = $role === 'student'
            ? \App\Models\User::where('role', 'lecturer')->get()
            : \App\Models\User::where('role', 'student')->get();

        return view('shared.email-form', compact('formAction', 'users'));
    }



    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $sender = auth()->user();

        
        $recipient = User::where('email', $data['recipient_email'])->firstOrFail();

      
        FMessage::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'subject' => $data['subject'],
            'body' => $data['message'],
        ]);

        // Send the actual email
        Mail::to($recipient->email)
            ->send(new EEFuserToUserEmail($sender, $data['subject'], $data['message']));

        return back()->with('success', 'Email sent and saved successfully!');
    }

    public function inbox()
    {
        $userId = auth()->id();

        // Fetch messages where the user is sender or recipient, newest first
        $messages = FMessage::where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->orderBy('created_at', 'desc')
            ->with(['sender', 'recipient'])  
            ->get();

        return view('emails.inbox', compact('messages'));
    }

    public function show($id)
    {
        $message = FMessage::with(['sender', 'recipient'])->findOrFail($id);

        
        if (auth()->id() === $message->recipient_id && is_null($message->read_at)) {
            $message->update(['read_at' => now()]);
        }

        return view('emails.show', compact('message'));
    }
}
