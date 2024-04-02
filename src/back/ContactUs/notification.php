<?php
require 'sendEmail.php';
function notification()
{
    $subject = "Support Request";
    $body = "
        <html>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Support Request</title>
                <style>
                    body {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background-color: #f9f9f9;
                        color: #444;
                        padding: 20px;
                        line-height: 1.6;
                        margin: 0;
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
                    .message {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                        margin-bottom: 20px;
                        text-align: center;
                    }
                    h1 {
                        color: #28536B;
                        margin-bottom: 20px;
                        font-size: 36px;
                    }
                    p {
                        margin-bottom: 15px;
                        font-size: 20px;
                        color: #666;
                    }
                    .button {
                        display: inline-block;
                        background-color: #28536B;
                        color: #fff !important;
                        font-size: 18px;
                        text-decoration: none;
                        padding: 10px 20px;
                        border-radius: 5px;
                        transition: background-color 0.3s ease;
                        text-decoration: none;
                    }
                    .button:hover {
                        background-color: #1d3c4f;
                        color: #fff !important;
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
                    <h1>Support Request</h1>
                    <p>Dear Admin,</p>
                    <p>A user has sent a support request. Please log in to the admin panel to verify and respond to it.</p>
                    <div style='text-align: center;'>
                        <a href='http://localhost:8080/admin' class='button'>Go to Admin Panel</a>
                    </div>
                </div>
                    <p class='footer'>Best regards,<br>INSAT Social Club</p>
                 </div>
            </body>
        </html>
    ";
    return sendEmail('insatsocialclubadm1n@gmail.com',$subject,$body);     //put your email in the first parameter

}