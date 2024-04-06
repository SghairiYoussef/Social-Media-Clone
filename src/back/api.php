<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


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
include "Authentication/isLoggedIn.php";
include "Authentication/setRememberMe.php";
include "Authentication/logout.php";
include "Authentication/getUserData.php";
include "Authentication/setStatus.php";
include "Messenger/getUsername.php";

$action = '';
if (isset($_GET['action'])) {

    $action = $_GET['action'];
}
if ($action == 'signup') {
    $username = $_POST['Username'];
    $email = $_POST['Email'];

    // Call signupProcess function
    $result = verifyExistence('UserData', $email, $username);
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
        $result = sendVerificationEmail($email, $verification);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Verification code sent to your email', 'code' => $verification]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send verification code']);
        }

    }
    if ($action == 'verificationProcess') {
        $code = $_POST['code'];
        $verification = $_POST['verificationCode'];
        $fullName = $_POST['FullName'];
        $email = $_POST['Email'];
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $birthDate = $_POST['BirthDate'];
        $result = $code === $verification;
        if ($result) {
            $result = signup('UserData', $fullName, $email, $username, $password, $birthDate);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Signed up successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to sign up']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Verification code is incorrect']);
        }
    }


    if ($action == 'login') {
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
            $userData = getUserData('UserData', 'username', $username);
            $_SESSION['userId'] = $userData['userID'];
            $_SESSION['email'] = $userData['email'];
            $isAdmin=$_SESSION['email']==='insatsocialclubadm1n@gmail.com';
            if ($rememberMe) {
                $result = setRememberMe('UserData', $username);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'User logged in successfully and remember me set','sessionID'=>$sessionID,'userId'=>$_SESSION['userId'],'isAdmin'=>$isAdmin]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to log in user and set remember me']);
                }
            } else {
                echo json_encode(['success' => true, 'message' => 'User logged in successfully','sessionID'=>$sessionID,'userId'=>$_SESSION['userId'],'isAdmin'=>$isAdmin]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to log in user']);
        }

    }


    if ($action == 'resetPasswordRequest') {
        $email = $_POST['email'];
        $result = verifyEmail('UserData', $email);
        if ($result) {
            $token = generateToken();
            $data = ['email' => $email];
            $result = addToken('UserData', $data, $token, 'resetPasswordToken');
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
    $token = $_POST['resetPasswordToken'];
    $password = $_POST['password'];
    $result = checkToken('UserData', $token, 'resetPasswordToken');
    if ($result) {

        if ($action == 'resetPassword') {
            $token = $_POST['resetPasswordToken'];
            $password = $_POST['password'];
            $result = checkToken('UserData', $token, 'resetPasswordToken');
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
            $isAdmin=$_SESSION['email']==='insatsocialclubadm1n@gmail.com';
            echo json_encode(['success' => true, 'message' => 'User is logged in','sessionID'=>session_id(),'userId'=>$_SESSION['userId'],'isAdmin'=>$isAdmin]);
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
    $username = getUsername();
    $result = logout($username);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User logged out']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to log out user']);
    }

}

if($action=='verifyAdmin') {
    if (isset($_POST['sessionId'])){
        $sessionID = $_POST['sessionId'];
        session_id($sessionID);
        session_start();
        $userId = $_SESSION['userId'];
    }
    $userData = getUserData('userData','userID',$userId);
    $isAdmin=$userData['email']==='insatsocialclubadm1n@gmail.com';
    if ($isAdmin) {
        echo json_encode(['success' => true, 'message' => 'User is an admin', 'isAdmin' => $isAdmin]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User is not an admin']);
    }
}

if($action == 'setOffline'){
    if (isset($_POST['sessionId'])){
        $sessionID = $_POST['sessionId'];
        session_id($sessionID);
        session_start();
    }
    $username = getUsername();
    $result = setStatus($username, 'Offline');
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User status set to offline']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to set user status to offline']);
    }  
}
if($action == 'setOnline'){
    if (isset($_POST['sessionId'])){
        $sessionID = $_POST['sessionId'];
        session_id($sessionID);
        session_start();
    }
    $username = getUsername();
    $result = setStatus($username, 'Online');
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User status set to offline']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to set user status to offline']);
    }
    
}