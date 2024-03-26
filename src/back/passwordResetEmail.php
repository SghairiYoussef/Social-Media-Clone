<?php
function passwordResetEmail($email, $URL)
{
    $subject = "Reset Password";
    $body = "
        <h1>Password Reset</h1>
        <p>Click the link below to reset your password</p>
        <a href='$URL'>Reset Password</a>
    ";
    return sendEmail($email, $subject, $body);

}
