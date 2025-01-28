<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ICE IT SOLUTIONS' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #f0f0f0;
        }

        .logo {
            max-width: 200px;
            height: auto;
        }

        .content {
            padding: 30px 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 2px solid #f0f0f0;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px;
            margin: 20px 0;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            margin: 0 10px;
            color: #666;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="data:image/jpeg;base64,{{ $logoData }}" alt="ICE IT SOLUTIONS Logo"
                style="max-width: 200px; height: auto; margin: 20px 0;">
        </div>

        <div class="content">
            @yield('content')
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} ICE IT SOLUTIONS. All rights reserved.</p>
            <div class="social-links">
                <a href="#">Facebook</a> |
                <a href="#">Twitter</a> |
                <a href="#">LinkedIn</a>
            </div>
            <p>If you have any questions, contact us at support@iceitsolutions.com</p>
        </div>
    </div>
</body>

</html>
