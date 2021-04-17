<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComputerCreated extends Mailable
{
    use Queueable, SerializesModels;

    var $computer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($computer)
    {
        $this->computer = $computer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to('zulip+test.99da96c384c7a148b5e62549da198e51.prefer-html@stratum0.org')
            ->subject('Computerliste')
            ->view('emails.computers.created');
    }
}
