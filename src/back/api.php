<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
include "function.php";
include "getPosts.php";

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
        echo json_encode(['success' => true, 'message' => 'User logged in successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to log in user']);
    }

}elseif($action == 'getAllPosts'){
    $user_id = 2;
    $result = getPostsForFeed(2);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}