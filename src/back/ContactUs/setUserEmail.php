<?php
require 'userSendEmail.php';
function setUserEmail($email,$fullName,$message)
{
    $subject = "Support Request";
    $body = "
    <h1>Support Request</h1>
    <p>$message</p>
    ";
    return userSendEmail($email,$fullName,$subject,$body);
}