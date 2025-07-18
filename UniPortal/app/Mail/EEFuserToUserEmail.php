<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EEFuserToUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $subjectLine;
    public $messageBody;

    public function __construct($sender, $subjectLine, $messageBody)
    {
        $this->sender = $sender;
        $this->subjectLine = $subjectLine;
        $this->messageBody = $messageBody;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.user-to-user')
                    ->with([
                        'senderName' => $this->sender->name,
                        'messageBody' => $this->messageBody,
                    ]);
    }
}
