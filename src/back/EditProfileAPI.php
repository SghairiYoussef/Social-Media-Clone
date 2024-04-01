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

if ($action == 'DetailsFetch'){
    $sessionId = $_POST['sessionId'];
    session_id($sessionId);
    session_start();
    $result = fetchDetails($userId);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Details fetched successfully', 'data' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch details']);
    }
}

