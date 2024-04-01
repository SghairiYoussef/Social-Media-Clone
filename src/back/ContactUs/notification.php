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
            /* Add your custom styles here */
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }
                .logo {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .logo img {
                    max-width: 100px;
                    height: auto;
                }
                .message {
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #fff;
                    text-decoration: none;
                    border-radius: 5px;
                }
            </style>
                </head>
                <body>
                    <div class='container'>
                        <p class='logo'>
                            <img src='https://i.imgur.com/W911Nk3.gif' alt='INSAT: Social Club Logo' width='300' height='300'>
                        </p>
                        <div class='message'>
                            <p>Dear Admin,</p>
                                <p>Someone has sent a support request. Please log in to the admin panel to verify and respond to it.</p>
                        </div>
                        <div class='button-container'>
                        <a href='http://localhost:8080/admin' class='button'>Go to Admin Panel</a>
                        </div>
                    </div>
                </body>
                </html>
    ";
    return sendEmail('',$subject,$body);     //put your email in the first parameter

}