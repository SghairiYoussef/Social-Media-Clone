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
        <h1>Verification</h1>
        <p>Your verification code is: $verificationCode</p>
        <br>
        <p>Put this code in the verification form to complete the registration process</p>
    ";
    return sendEmail($email, $subject, $body);
}
?>