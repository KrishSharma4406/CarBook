<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <h2>Verify Your Email</h2>

    <p>Hello,</p>

    <p>Your OTP for registration is:</p>

    <h1 style="color:#0d6efd;">{{ $otp }}</h1>

    <p>This OTP is valid for 5 minutes.</p>

    <p>Do not share this OTP with anyone.</p>

    <br>

    <p>Thanks,<br>{{ config('app.name') }}</p>

</body>
</html>