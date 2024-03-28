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
include "Controllers/getPosts.php";
include "Controllers/getUserPosts.php";
include "Controllers/getUser.php";
include "Controllers/getUserID.php";
include "Controllers/addPost.php";
include "Controllers/addComment.php";
$action='';
if (isset($_GET['action'])) {

    $action=$_GET['action'];
}
if($action == 'getAllPosts'){
    //$user_id = $_SESSION['CurrentUserID'];;
    $result = getPostsForFeed(2);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'getCurrentUserPosts'){
    //$user_id = $_SESSION['CurrentUserID'];;
    $result = getUserPosts(2);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'getCurrentUserProfile'){
    //$user_id = $_SESSION['CurrentUserID'];
    $result = getUser(2);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'addPost'){
    //$user_id = $_SESSION['CurrentUserID'];
    $Caption = $_POST['Content'];
    $Title = $_POST['Title'];
    $Media = $_POST['Media'];
    $result = addPost(2, $Caption, $Title,$Media);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Post added successfully']);
    } else {

        echo json_encode(['success' => false, 'message' => 'Error adding post']);
    }
}
if($action == 'addComment'){
    //$user_id = $_SESSION['CurrentUserID'];
    $Caption = $_POST['Content'];
    $Post_ID = $_POST['Post_ID'];
    $result = addComment(2, $Post_ID,$Caption);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Comment added successfully']);
    } else {

        echo json_encode(['success' => false, 'message' => 'Error adding Comment']);
    }
}

