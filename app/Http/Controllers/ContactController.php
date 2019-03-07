<?php

namespace App\Http\Controllers;

use Session;
use App\Notifications\SendingUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ContactController extends Controller
{
    // Show Contact Form Page (/contact)
    public function showForm($id, $username, $email) {
    	return view('contact.form', ['id' => $id, 'username' => $username, 'email' => $email]);
    }

    // Send Email (/contact)
    public function sendEmail(Request $request) {

    	$this->validate($request, [
    		'username' => 'required|max:255|string',
    		'email' => 'required|email|max:255',
    		'url' => 'required'
    	]);


	    // // Session::flash('success', 'The email was sent successfully!');
		$image_logo = 'images/readersmagnet-logo.png';
		$image_social = 'images/social-media.jpg';
		$to_name =$request->username;
		$to_email = $request->email;
		$to_bcc = (['jojie.jagonos23@gmail.com', 
		            'jerene47@gmail.com']);

		            
        // Send Data to SendMail Mail
        Mail::to($to_email)
                ->bcc($to_bcc)
                ->send(new SendMail($request));

        return back()->with('message', 'The email was sent successfully!');

    }
}
