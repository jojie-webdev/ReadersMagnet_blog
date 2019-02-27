<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class SendMail extends Mailable
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
        return $this->view('contact.mail')->with([
                        'name' => $this->request->username,
                        'url' => $this->request->url,
                        'image_logo' => public_path()."/images/readersmagnet-logo.png",
                    ])
                    ->subject("Authors' Lounge | Your Article has been approved")
                    ->from('authorslounge@readersmagnet.club', "ReadersMagnet Authors' Lounge");
    }
}
