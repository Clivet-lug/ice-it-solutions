<?php

namespace App\Helpers;

use App\Mail\WelcomeEmail;
use App\Mail\RequestConfirmation;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    /**
     * Send welcome email to newly registered user
     * 
     * @param object $user User object containing email and name
     * @return void
     */
    public static function sendWelcomeEmail($user)
    {
        Mail::to($user->email)->send(new WelcomeEmail($user));
    }

    /**
     * Send request confirmation email
     * 
     * @param object $request Request details
     * @param string $type Type of request (service/pricing)
     * @return void
     */
    public static function sendRequestConfirmation($request, $type)
    {
        Mail::to($request->email)->send(new RequestConfirmation($request, $type));
    }
}