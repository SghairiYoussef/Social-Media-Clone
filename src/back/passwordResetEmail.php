<?php
function passwordResetEmail($email, $URL)
{
    $subject = "Reset Password";
    $body = "
            <html>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Password Reset</title>
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
                .message {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
                a {
                    display: inline-block;
                    background-color: #28536B;
                    color: #fff;
                    text-decoration: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    transition: background-color 0.3s ease;
                }
                a:hover {
                    background-color: #1d3c4f;
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
                        <div class='message'>
                            <h1>Password Reset</h1>
                            <p>Click the link below to reset your password</p>
                            <a href='$URL'>Reset Password</a>
                        </div>
                        <p class='footer'>Best regards,<br>esm l website</p>
                    </div>
                </body>
            </html>
";

    return sendEmail($email, $subject, $body);

}