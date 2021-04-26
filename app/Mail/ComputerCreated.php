<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        return $this
            ->to($user->currentTeam->notfification_email)
            ->subject('Computerliste')
            ->view('emails.computers.created');
    }
}
