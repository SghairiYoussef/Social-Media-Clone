<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include "EditProfile/fetch.php";

$action = '';
if (isset($_GET['action'])) {

    $action = $_GET['action'];
}

/*if ($action == 'update'){
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $birthDate = $_POST['birthDate'];
    $bio = $_POST['bio'];


    $email = $_POST['email'];
    $password = $_POST['password'];


    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];



    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
    }

}*/

if ($action == 'DetailsFetch'){
    $sessionId = $_POST['sessionId'];
    session_id($sessionId);
    session_start();
    $result = fetchDetails();
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Details fetched successfully', 'data' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch details']);
    }
}

