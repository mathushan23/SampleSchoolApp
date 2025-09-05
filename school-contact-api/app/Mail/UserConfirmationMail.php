<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // accessible in the view

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('We received your message')
                    ->markdown('emails.user_confirmation'); 
    }
}
