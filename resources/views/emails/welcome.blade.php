@extends('emails.layouts.main')

@section('content')
    <h2>Welcome to ICE IT SOLUTIONS, {{ $user->name }}!</h2>

    <p>Thank you for joining our community. We're excited to have you on board and look forward to helping you achieve your
        technology goals.</p>

    <div class="info-box">
        <h3>What We Offer:</h3>
        <ul>
            <li><strong>Website Development:</strong> Custom-built, responsive websites</li>
            <li><strong>Software Development:</strong> Tailored software solutions</li>
            <li><strong>Document Formatting:</strong> Professional document services</li>
            <li><strong>PowerPoint Design:</strong> Engaging presentation designs</li>
        </ul>
    </div>

    <p>Ready to get started? Explore our services and see how we can help you:</p>

    <p style="text-align: center;">
        <a href="{{ route('services') }}" class="button">Explore Our Services</a>
    </p>

    <div class="info-box">
        <h3>Quick Links:</h3>
        <ul>
            <li><a href="{{ route('services') }}">Our Services</a></li>
            <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
    </div>

    <p>We're committed to providing you with the best possible service. If you have any questions or need assistance, don't
        hesitate to reach out to our support team.</p>
@endsection
