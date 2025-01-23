<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You're Invited!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .email-body {
            padding: 20px;
            line-height: 1.6;
        }

        .email-body p {
            margin: 0 0 15px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .email-footer {
            background: #f4f4f9;
            color: #888;
            text-align: center;
            font-size: 12px;
            padding: 10px;
        }

        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            You're Invited!
        </div>
        <div class="email-body">
            <p>Hi,</p>
            <p>You have been invited to join our URL Shortener application as a valued member.</p>
            <p>To accept this invitation and create your account, please click the button below:</p>
            <a href="{{ $link }}" class="btn">Join Now</a>
            <p>If you did not request this invitation, you can safely ignore this email.</p>
        </div>
        <div class="email-footer">
            <p>Need help? <a href="mailto:support@example.com">Contact support</a></p>
            <p>&copy; 2025 URL Shortener. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
