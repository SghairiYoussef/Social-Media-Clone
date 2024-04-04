<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include 'Messenger/getUsername.php';
include 'Messenger/getUsers.php';
include 'Messenger/fetch.php';
include 'Messenger/send.php';
include 'DataBase.php';
$action = '';
if (isset($_GET['action'])) {

    $action = $_GET['action'];
}
if($action == 'getUsers'){
    $sessionId = $_POST['sessionId'];
    session_id($sessionId);
    session_start();
    $currentUserId = $_SESSION['userId'];
    $users = getUsers($currentUserId);
    echo json_encode($users);
}
if($action == 'displayMessages'){
    $sessionId = $_POST['sessionId'];
    $selectedUserName = $_POST['userName'];
    session_id($sessionId);
    session_start();
    $_SESSION['to_name']=$selectedUserName;
    $result= displayMessages();
    if($result){
        echo json_encode(['success'=>true,'messages'=>$result]);
    }else{
        echo json_encode(['success'=>false,'message'=>'No recipient selected']);
    }
}
if($action == 'sendMessage'){
    $sessionId = $_POST['sessionId'];
    $message = $_POST['message'];
    session_id($sessionId);
    session_start();
    $result = send($message);
    if($result){
        echo json_encode(['success'=>true,'message'=>'Message sent']);
    }else{
        echo json_encode(['success'=>false,'message'=>'Failed to send message']);
    }
}

if($action == 'getCurrentUserName'){
    $sessionId = $_POST['sessionId'];
    session_id($sessionId);
    session_start();
    $result = getUsername();
    if($result){
        echo json_encode(['success'=>true,'username'=>$result]);
    }else{
        echo json_encode(['success'=>false,'message'=>'Failed to get username']);
    }
}