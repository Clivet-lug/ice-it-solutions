@extends('emails.layouts.main')

@section('content')
<h2>Thank You for Contacting Us</h2>

<p>Dear {{ $contact->name }},</p>

<p>We have received your message and will get back to you as soon as possible.</p>

<h3>Your Message Details:</h3>
<ul>
    <li><strong>Subject:</strong> {{ $contact->subject ?? 'Not provided' }}</li>
    <li><strong>Message:</strong> {{ $contact->message }}</li>
</ul>

<p>If you have any additional questions, please don't hesitate to contact us.</p>

<p>Best regards,<br>{{ config('app.name') }} Team</p>
@endsection