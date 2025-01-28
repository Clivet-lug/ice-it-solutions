<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $logoData;

    public function __construct($user)
    {
        $this->user = $user;
        $this->logoData = base64_encode(file_get_contents(public_path('images/logo.jpg')));
    }

    public function build()
    {
        return $this->subject('Welcome to ICE IT SOLUTIONS!')
            ->view('emails.welcome')
            ->with([
                'title' => 'Welcome to ICE IT SOLUTIONS',
                'logoData' => $this->logoData
            ]);
    }
}