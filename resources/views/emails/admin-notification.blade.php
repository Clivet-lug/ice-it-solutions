@extends('emails.layouts.main')

@section('content')
    <h2>New Contact Form Submission</h2>
    <p>A new contact form submission has been received:</p>

    <ul>
        <li><strong>Name:</strong> {{ $contact->name }}</li>
        <li><strong>Email:</strong> {{ $contact->email }}</li>
        <li><strong>Phone:</strong> {{ $contact->phone ?? 'Not provided' }}</li>
        <li><strong>Subject:</strong> {{ $contact->subject ?? 'Not provided' }}</li>
    </ul>

    <h3>Message:</h3>
    <p>{{ $contact->message }}</p>

    <p>
        <a href="{{ route('admin.contact.list') }}" class="button">View in Admin Panel</a>
    </p>
@endsection
