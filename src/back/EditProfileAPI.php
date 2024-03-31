<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');



$action = '';
if (isset($_GET['action'])) {

    $action = $_GET['action'];
}

if ($action == 'update'){
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

}

/*if ($action == 'login') {
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $rememberMe = $_POST['rememberMe'];
        $rememberMe = $rememberMe === 'true';
        // Call logIn function
        $result = logIn('UserData', $username, $password);
        if ($result) {
            $id=generateToken();
            session_id($id);
            session_start();
            $_SESSION['loggedIn'] = true;
            $sessionID = session_id();
            $userId = getUserId('UserData', 'username', $username);
            $_SESSION['userId'] = $userId;
            if ($rememberMe) {
                $result = setRememberMe('UserData', $username);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'User logged in successfully and remember me set','sessionID'=>$sessionID]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to log in user and set remember me']);
                }
            } else {
                echo json_encode(['success' => true, 'message' => 'User logged in successfully','sessionID'=>$sessionID]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to log in user']);
        }

    }

if ($action == 'isLoggedIn') {
    if (isset($_POST['sessionId']))
 {
        $sessionID = $_POST['sessionId'];
        session_id($sessionID);
        session_start();
    }
    else {
        $id=generateToken();
        session_id($id);
        session_start();
    }
    $result = isLoggedIn();
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'User is logged in','sessionID'=>session_id()]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User is not logged in']);
        }


}
if($action=='logout') {
    if (isset($_POST['sessionID'])) {
        $sessionID = $_POST['sessionID'];
        session_id($sessionID);
        session_start();
    }
    $result = logout();
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User logged out']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to log out user']);
    }

}*/

