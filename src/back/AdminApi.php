<?php


if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one you want to allow
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}, Content-Type"); // Add Content-Type to allowed headers
    }
    exit(0);
}

// Set Content-Type header to allow POST requests
header("Content-Type: application/json");
include "Controllers/getAllUsers.php";
include "Controllers/deleteUser.php";

$action='';
if (isset($_GET['action'])) {

    $action=$_GET['action'];
}
if($action == 'getAllUsers'){
    $result = getAllUsers();
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'deleteUser'){
    $User_ID = $_POST['User_ID'];
    $result = deleteUser($User_ID);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User deleted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
    }

}
