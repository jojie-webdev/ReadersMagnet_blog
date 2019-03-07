<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Thankyou extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to_name)
    {
        $this->to_name  = $to_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('contact.thankyou')->with([
            'name' => $this->to_name
        ])
        ->subject("Authors' Lounge | Thank You")
        ->from('authorslounge@readersmagnet.club', "ReadersMagnet Authors' Lounge");
    }
}
