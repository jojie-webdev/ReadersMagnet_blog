<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class Disapproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    protected $request;
    
    public function __construct(Request $request)
    {
        $this->request  = $request;
        // dd($message->username);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('contact.disapproved')->with([
            'name' => $this->request->name,
            'reason' => $this->request->reason,
        ])
        ->subject("Authors' Lounge | Your Article has been disapproved!")
        ->from('authorslounge@readersmagnet.club', "ReadersMagnet Authors' Lounge");
    }
}
