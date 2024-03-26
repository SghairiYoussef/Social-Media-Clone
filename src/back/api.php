<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
include "function.php";
include "getPosts.php";
include "getUserPosts.php";
include "getUser.php";
include "getUserID.php";
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
    $user_id = $_SESSION['CurrentUserID'];;
    $result = getUser($user_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}