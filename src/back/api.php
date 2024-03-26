<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include 'login.php';
include 'verifyExistence.php';
include 'verification.php';
include 'signup.php';
include "getPosts.php";
include "verifyEmail.php";
include "generateToken.php";
include "addToken.php";
include "checkToken.php";

$action='';
if (isset($_GET['action'])) {

    $action=$_GET['action'];
}
if ($action == 'signup') {
    $username = $_POST['Username'];
    $email = $_POST['Email'];

    // Call signupProcess function
    $result= verifyExistence('UserData', $email, $username);
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
    $result=sendVerificationEmail($email, $verification);
    if($result){
        echo json_encode(['success' => true, 'message' => 'Verification code sent to your email','code' => $verification]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Failed to send verification code']);
    }

}
if ($action == 'verificationProcess'){
    $code=$_POST['code'];
    $verification=$_POST['verificationCode'];
    $fullname=$_POST['FullName'];
    $email=$_POST['Email'];
    $username=$_POST['Username'];
    $password=$_POST['Password'];
    $birthDate=$_POST['BirthDate'];
    $result=$code=== $verification;
    if ($result){
        $result = signup('UserData', $fullname, $email, $username, $password, $birthDate);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Signed up successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to sign up']);
        }
    }else{
        echo json_encode(['success' => false, 'message' => 'Verification code is incorrect']);
    }
}


if ($action == 'login') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    // Call logIn function
    $result = logIn('UserData', $username, $password);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User logged in successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to log in user']);
    }

}
if($action == 'getAllPosts'){
    $user_id = 2;
    $result = getPostsForFeed(2);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}

if ($action == 'resetPasswordRequest') {
    $email = $_POST['email'];
    $result = verifyEmail('UserData', $email);
    if ($result) {
        $token = generateToken();
        $result = addToken('UserData', $email, $token);
        if ($result) {
            $URL = "http://localhost:8080/login/passwordReset/" . $token;
            $result = sendEmail($email, 'Password Reset', $URL);
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
    $email = $_POST['email'];
    $result = checkToken('UserData', $email, $token);
    if ($result) {
        $result = resetPassword('UserData', $email, $password);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Password reset successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to reset password']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid token']);
    }
}
