<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 10px auto;
      background: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .header {
      text-align: center;
      padding-bottom: 20px;
      border-bottom: 1px solid #ddd;
    }
    .header h1 {
      color: #333;
    }
    .content {
      margin-top: 20px;
      line-height: 1.6;
      color: #333;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      font-size: 16px;
      color: #ffffff;
      background: #058b09;
      text-decoration: none;
      border-radius: 5px;
    }
    .footer {
      margin-top: 30px;
      font-size: 12px;
      text-align: center;
      color: #999;
    }
  </style>

</head>

<body>
  <div class="container">
    <div class="header">
      <h3>Password Reset Request</h3>
    </div>

    <div class="content">
      <p>Hello,</p>
      <p>You are receiving this email because we received a password reset request for your account.</p>
      <p>Click the button below to reset your password:</p>
      <a href="{{ $resetLink }}" class="button">Reset Password</a>
      <p>If you did not request a password reset, no further action is required.</p>
    </div>

    <div class="footer">
      <p>&copy; {{ date('Y') }} My Laravel App. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
