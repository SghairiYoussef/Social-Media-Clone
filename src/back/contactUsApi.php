<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include 'ContactUs/setUserEmail.php';
$action = '';
if (isset($_GET['action'])) {

    $action = $_GET['action'];
}
if ($action == 'contactUs') {
    $email = $_POST['email'];
    $fullName = $_POST['name'];
    $message = $_POST['message'];
    $result = setUserEmail($email,$fullName,$message);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    }

}