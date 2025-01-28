<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $type;
    public $logoData;

    public function __construct($request, $type)
    {
        $this->request = $request;
        $this->type = $type;
        $this->logoData = base64_encode(file_get_contents(public_path('images/logo.jpg')));
    }

    public function build()
    {
        return $this->subject('Request Confirmation - ' . ucfirst($this->type))
            ->view('emails.request-confirmation')
            ->with([
                'title' => 'Request Confirmation',
                'logoData' => $this->logoData
            ]);
    }
}