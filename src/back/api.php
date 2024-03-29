<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include 'Authentication/login.php';
include 'Authentication/verifyExistence.php';
include 'Authentication/verification.php';
include 'Authentication/signup.php';
include "Authentication/verifyEmail.php";
include "Authentication/generateToken.php";
include "Authentication/addToken.php";
include "Authentication/checkToken.php";
include "Authentication/resetPassword.php";
include "Authentication/passwordResetEmail.php";
include "Authentication/isLoggedIn.php";
if (isset($_GET['PHPSESSID'])) {
    // Set the session ID provided in the URL
    session_id($_GET['PHPSESSID']);
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = '';
    if (isset($_GET['action'])) {

        $action = $_GET['action'];
    }
    if ($action == 'signup') {
        $username = $_POST['Username'];
        $email = $_POST['Email'];

        // Call signupProcess function
        $result = verifyExistence('UserData', $email, $username);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Username and Email are available']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Username or Email already exists']);
        }
    }

    if ($action == 'verify') {
        $email = $_POST['Email'];
        // Generate a verification code
        $verification = generateVerificationCode();
        $result = sendVerificationEmail($email, $verification);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Verification code sent to your email', 'code' => $verification]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send verification code']);
        }

    }
    if ($action == 'verificationProcess') {
        $code = $_POST['code'];
        $verification = $_POST['verificationCode'];
        $fullName = $_POST['FullName'];
        $email = $_POST['Email'];
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $birthDate = $_POST['BirthDate'];
        $result = $code === $verification;
        if ($result) {
            $result = signup('UserData', $fullName, $email, $username, $password, $birthDate);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Signed up successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to sign up']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Verification code is incorrect']);
        }
    }


    if ($action == 'login') {
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $rememberMe = $_POST['rememberMe'];
        $rememberMe = $rememberMe === 'true';
        // Call logIn function
        $result = logIn('UserData', $username, $password);
        if ($result) {
            $_SESSION['loggedIn'] = false;
            if ($rememberMe) {
                $result = setRememberMe('UserData', $username);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'User logged in successfully and remember me set']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to log in user and set remember me']);
                }
            } else {
                echo json_encode(['success' => true, 'message' => 'User logged in successfully']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to log in user']);
        }

    }


    if ($action == 'resetPasswordRequest') {
        $email = $_POST['email'];
        $result = verifyEmail('UserData', $email);
        if ($result) {
            $token = generateToken();
            $data = ['email' => $email];
            $result = addToken('UserData', $data, $token, 'resetPasswordToken');
            if ($result) {
                $URL = "http://localhost:8080/login/passwordReset/" . $token;
                $result = passwordResetEmail($email, $URL);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Password reset link sent to your email']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to send password reset link']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add token']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Email does not exist']);
        }
    }

    if ($action == 'resetPassword') {
        $token = $_POST['token'];
        $password = $_POST['password'];
        $result = checkToken('UserData', $token, 'resetPasswordToken');
        if ($result) {

            $result = resetPassword('UserData', $token, $password);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Password reset successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to reset password']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid token']);
        }
    }
}
else if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = isLoggedIn();
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User is logged in']);
    } else {
        echo json_encode(['success' => false, 'message' => 'User is not logged in']);
    }
}


