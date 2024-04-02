<?php
require 'sendEmail.php';

function generateVerificationCode()
{
    // Generate a random string of 6 characters
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $verificationCode = '';
    $length = strlen($characters);
    for ($i = 0; $i < 6; $i++) {
        $verificationCode .= $characters[rand(0, $length - 1)];
    }
    return $verificationCode;
}

function sendVerificationEmail($email, $verificationCode)
{
    $subject = "Verification";
    $body = "
    <html>
    <head>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f9f9f9;
                color: #444;
                padding: 20px;
                line-height: 1.6;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
            }
            .logo {
                text-align: center;
                margin-bottom: 20px;
            }
            .logo img {
                max-width: 150px;
                height: auto;
                border-radius: 50%;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }
            h1 {
                color: #28536B;
                margin-bottom: 20px;
                text-align: center;
                font-size: 36px;
            }
            p {
                margin-bottom: 15px;
                font-size: 20px;
            }
            .message {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            .footer {
                text-align: center;
                margin-top: 20px;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class='container'>
        <div class='logo'>
            <img src='https://i.imgur.com/W911Nk3.gif' alt='INSAT: Social Club Logo'>
        </div>
            <div class='message'>
                <h1>Email Verification</h1>
                <p>Dear User,</p>
                <p>Your verification code is: <strong>$verificationCode</strong></p>
                <p>Please use this code to complete the registration process.</p>
                <p>If you did not request this verification code, please ignore this email.</p>
            </div>
            <p class='footer'>Best regards,<br>INSAT Social Club</p>
        </div>
    </body>
    </html>
";
    return sendEmail($email, $subject, $body);
}
?>