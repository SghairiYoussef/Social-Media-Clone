<?php

/*header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');*/

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one you want to allow
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}, Content-Type"); // Add Content-Type to allowed headers
    }
    exit(0);
}

// Set Content-Type header to allow POST requests
header("Content-Type: application/json");

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

include "getPosts.php";
include "getUserPosts.php";
include "getUser.php";
include "getUserID.php";
include "addPost.php";


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
        //saving the current user id in session storage
        $user_id = getUserID($username);
        $_SESSION['CurrentUserID'] = $user_id;
        echo json_encode(['success' => true, 'message' => 'User logged in successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to log in user']);
    }

}elseif($action == 'getAllPosts'){
    $user_id = $_SESSION['CurrentUserID'];;
    $result = getPostsForFeed($user_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
elseif($action == 'getCurrentUserPosts'){
    $user_id = $_SESSION['CurrentUserID'];;
    $result = getUserPosts($user_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
elseif($action == 'getCurrentUserProfile'){
    $user_id = $_SESSION['CurrentUserID'];
    $result = getUser($user_id);
}
if($action == 'getAllPosts'){
    $user_id = 2;
    $result = getPostsForFeed(2);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}elseif($action = 'addPost'){
    $user_id = $_SESSION['CurrentUserID'];
    $Caption = $_POST['Content'];
    $Title = $_POST['Title'];
    $Media = $_POST['Media'];
    $result = addPost($user_id, $Caption, $Title,$Media);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Signed up successfully']);
    } else {

        echo json_encode(['success' => false, 'message' => 'Username or Email already exists']);
    }
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
    $result = checkToken('UserData', $token);
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
