<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'C:\xampp\htdocs\php\Social-Media-Clone\vendor\autoload.php';

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
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'youssef.fazloun@gmail.com';
        $mail->Password = 'ffdw efhd xfqu osxe';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        //Recipients
        $mail->setFrom('youssef.fazloun@gmail.com', 'Mailer');
        $mail->addAddress($email);


        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Here is the subject';
        $mail_template = "
    <h1>Verification</h1>
    <p>Your verification code is: $verificationCode</p>
    <br>
    <p>Put this code in the verification form to complete the registration process</p> 
        ";
        $mail->Body = $mail_template;

        $mail->send();
        return true;
    }
    catch (Exception $e) {
        return false;
    }
}
?>
