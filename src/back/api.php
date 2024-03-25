<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include 'login.php';
include 'verifyExistence.php';
include 'verification.php';
include 'signup.php';
include "getPosts.php";


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
