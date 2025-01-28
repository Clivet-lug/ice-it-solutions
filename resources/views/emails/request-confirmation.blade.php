@extends('emails.layouts.main')

@section('content')
    <h2>Request Confirmation</h2>

    <p>Dear {{ $request->name }},</p>

    <p>Thank you for submitting your {{ $type }} request. We're excited to work with you!</p>

    <div class="info-box">
        <h3>Request Details:</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0;"><strong>Reference Number:</strong></td>
                <td style="padding: 8px 0;">{{ $request->id }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Type:</strong></td>
                <td style="padding: 8px 0;">{{ ucfirst($type) }} Request</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Submitted:</strong></td>
                <td style="padding: 8px 0;">{{ $request->created_at->format('F j, Y g:i A') }}</td>
            </tr>
            @if ($type == 'service')
                <tr>
                    <td style="padding: 8px 0;"><strong>Service:</strong></td>
                    <td style="padding: 8px 0;">{{ $request->service->name ?? 'N/A' }}</td>
                </tr>
            @endif
        </table>
    </div>

    <div class="info-box">
        <h3>What's Next?</h3>
        <ol>
            <li>Our team will review your request within 24-48 hours</li>
            <li>You'll receive a detailed response with next steps</li>
            <li>We may contact you if we need any additional information</li>
        </ol>
    </div>

    <p style="text-align: center;">
        <a href="{{ route('contact') }}" class="button">Contact Support</a>
    </p>

    <p><strong>Note:</strong> Please keep your reference number handy for future correspondence.</p>
@endsection
