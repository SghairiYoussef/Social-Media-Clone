<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include 'Messenger/getUsers.php';
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