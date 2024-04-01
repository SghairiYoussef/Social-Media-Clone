<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include "EditProfile/fetch.php";
include "DataBase.php";
include "EditProfile/verifyUsername.php";
include "EditProfile/updatePersonalDetails.php";
include "EditProfile/verifyPassword.php";

$action = '';
if (isset($_GET['action'])) {

    $action = $_GET['action'];
}

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
if ($action == 'UpdatePersonalDetails'){
    $sessionId = $_POST['sessionId'];
    session_id($sessionId);
    session_start();
    $fullName = $_POST['fullName'] ?? '';
    $username = $_POST['username'] ?? '';
    $birthDate = $_POST['birthDate'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $oldPassword = $_POST['oldPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    if ($username && verifyUsername($username)) {
        echo json_encode(['success' => false, 'message' => 'Username already exists']);
        return;
    }
    if ($oldPassword && verifyPassword($oldPassword)) {
        echo json_encode(['success' => false, 'message' => 'Incorrect password']);
        return;
    } 
    $result = updatePersonalDetails($fullName, $username, $birthDate, $bio, $newPassword);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Personal details updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update personal details']);
    }
    
}

