<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssignTaskMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $body
     */
    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('mail.mailassigntask');
    }
}
