<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('Access-Control-Max-Age: 86400');

include "EditProfile/fetch.php";
include "DataBase.php";
include "EditProfile/verifyUsername.php";
include "EditProfile/updatePersonalDetails.php";
include "EditProfile/verifyPassword.php";
include "EditProfile/addAvatarName.php";

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

if (action == 'UploadAvatar'){
    $sessionId = $_POST['sessionId'];
    session_id($sessionId);
    session_start();
    $userId = $_SESSION['userId'];

    $file = $_FILES['avatar'];
    if (!isset($file) || $file['error'] != 0) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload avatar']);
        return;
    }
    $fileName = $_FILES['avatar']['name'];
    $fileTmpName = $_FILES['avatar']['tmp_name'];
    $fileError = $_FILES['avatar']['error'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    if($fileError === 0){
        
        $fileNameNew = uniqid('',true).'.'.$fileActualExt;
        if (!file_exists('avatars/')) {
            mkdir('avatar/', 0777, true);
            echo "Directory 'avatars/' created successfully.";
        }else{
            echo "Directory 'avatars/' already exists.";
        }
        $fileDestination = 'avatars/'.$fileNameNew;
        move_uploaded_file($fileTmpName,$fileDestination);
        $result = addAvatarName($fileNameNew, $userId);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Avatar uploaded successfully', 'path' => $fileDestination]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
        }        
    }
}

