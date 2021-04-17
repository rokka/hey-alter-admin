<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

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
        $recipient = App::environment('local') ? 'rokka@gmx.net' : 'zulip+heyalter_essen.416b79cfe446f5026ea9cba17347e9f8.prefer-html@stratum0.org';

        return $this
            ->to($recipient)
            ->subject('Computerliste')
            ->view('emails.computers.created');
    }
}
