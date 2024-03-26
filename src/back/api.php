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

include "function.php";
include "getPosts.php";
include "getUserPosts.php";
include "getUser.php";
include "getUserID.php";
include "addPost.php";
session_start();
$action='';
if (isset($_GET['action'])) {

    $action=$_GET['action'];
}
if ($action == 'signup') {
    $fullname = $_POST['FullName'];
    $username = $_POST['Username'];
    $birthDate = $_POST['BirthDate'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    // Call signUp function
    $result = signUp('UserData', $fullname, $email, $username, $password, $birthDate);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Signed up successfully']);
    } else {

        echo json_encode(['success' => false, 'message' => 'Username or Email already exists']);
    }
}
elseif ($action == 'login') {
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