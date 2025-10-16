<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; padding: 20px;">
    <div style="background: white; padding: 20px; max-width: 500px; margin: auto; border-radius: 5px;">
        <img src="{{ $logoUrl }}" alt="Dev-Shadin" style="max-width: 150px; margin-bottom: 20px;">
        <h2>Password Reset Request</h2>
        <p>You requested a password reset. Click the button below to reset your password.</p>
        <a href="{{ url(route('password.reset', $token, false)) }}"
            style="display: inline-block; padding: 10px 20px; color: white; background: #007bff; text-decoration: none; border-radius: 5px;">
            Reset Password
        </a>
        <p>If you did not request a password reset, no further action is required.</p>
        <p>Thanks, <br> Your Website Team</p>
    </div>
</body>

</html>
