<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        <h2>Hello!</h2>
        <p>Thank you for subscribing to {{ config('app.name') }}.</p>
        <p>Please confirm your subscription by clicking the button below:</p>
        <a href="{{ $verificationUrl }}" style="padding: 10px 20px; background: #3490dc; color: white; text-decoration: none;">Verify Email</a>
        <p>If you did not request this, you can ignore this message.</p>
    </body>
</html>