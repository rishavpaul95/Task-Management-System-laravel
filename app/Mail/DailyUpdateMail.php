<?php

namespace App\Mail;

use App\Models\Leads;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

class DailyUpdateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Leads $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Daily Update Mail')
                    ->view('mail.daily_update')
                    ->with([
                        'name' => $this->lead->name,
                    ]);

    }
}
