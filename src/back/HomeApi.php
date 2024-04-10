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
include "Controllers/deletePost.php";
include "Controllers/addReact.php";
include "Controllers/getAllUsers.php";
include "Controllers/fetchMedia.php";
include "Controllers/getPost.php";
include "Controllers/verifyMedia.php";
$action='';
if (isset($_GET['action'])) {

    $action=$_GET['action'];
}
if($action == 'getAllPosts'){
    $session_id= $_POST['sessionId'];
    session_id($session_id);
    session_start();
    $user_id = $_SESSION['userId'];
    $result = getPostsForFeed($user_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'getCurrentUserPosts'){
    $session_id= $_POST['sessionId'];
    session_id($session_id);
    session_start();
    $user_id = $_SESSION['userId'];
    $result = getUserPosts($user_id,$user_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'getCurrentUserProfile'){
    $session_id= $_POST['sessionId'];
    session_id($session_id);
    session_start();
    $user_id = $_SESSION['userId'];
    $result = getUser($user_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'addPost'){
    $session_id= $_POST['sessionId'];
    session_id($session_id);
    session_start();
    $user_id = $_SESSION['userId'];
    $Caption = $_POST['Content'];
    $file = $_FILES['Media'];
    $fileName = $_FILES['Media']['name'];
    $fileTmpName = $_FILES['Media']['tmp_name'];
    $fileSize = $_FILES['Media']['size'];
    $fileError = $_FILES['Media']['error'];
    $fileType = $_FILES['Media']['type'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');
    print_r("file");
    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            if($fileSize< 1000000){
                $fileNameNew = uniqid('',true).'.'.$fileActualExt;
                if (!file_exists('uploads/')) {
                    mkdir('uploads/', 0777, true);
                    echo "Directory 'uploads/' created successfully.";
                }else{
                    echo "Directory 'uploads/' already exists.";
                }
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                $fileDestination='../../src/back/'.$fileDestination;
                //change the user id
                $result = addPost($user_id, $Caption,$fileNameNew);
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Post added successfully']);
                } else {

                    echo json_encode(['success' => false, 'message' => 'Error adding post']);
                }

            }else{
                echo "Your file is too big!";
            }
        }else{
            echo 'There was an error uploading your file!';
        }
    }else{
        $result = addPost($user_id, $Caption, "");
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Post added successfully']);
                } else {

                    echo json_encode(['success' => false, 'message' => 'Error adding post']);
                }
    }
}
if($action == 'addComment'){
    $session_id= $_POST['sessionId'];
    session_id($session_id);
    session_start();
    $user_id = $_SESSION['userId'];
    $Caption = $_POST['Content'];
    $Post_ID = $_POST['Post_ID'];
    $result = addComment($user_id, $Post_ID,$Caption);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Comment added successfully']);
    } else {

        echo json_encode(['success' => false, 'message' => 'Error adding Comment']);
    }
}
if($action == 'getComments'){
    $Post_ID = $_POST['Post_ID'];
    $result = getComments($Post_ID);
    if ($result) {
        echo $result;
    } else {

        echo json_encode(['success' => false, 'message' => 'Error getting Comments']);
    }
}
if($action == 'deletePost'){
    $Post_ID = $_POST['Post_ID'];
    $media = fetchMedia($Post_ID);
    $isMediaUsedOnce = verifyMedia($media);
    $result = deletePost($Post_ID);
    if($media != "" && $isMediaUsedOnce){
        $mediaPath = 'uploads/'.$media;
        if (file_exists($mediaPath)) {
            unlink($mediaPath);
        }
    }
    if($result){
        echo json_encode(['success' => true, 'message' => 'Post deleted successfully']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Error deleting post']);
    }
}if($action == 'sharePost'){
    $session_id= $_POST['sessionId'];
    session_id($session_id);
    session_start();
    $user_id = $_SESSION['userId'];
    $Post_ID = $_POST['Post_ID'];
    $post = getPost($Post_ID);
    $result = addPost($user_id, $post['Caption'],$post['Media']);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Post shared successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error sharing post']);
    }

}
if($action == 'reactToPost'){
    $Post_ID = $_POST['Post_ID'];
    $user_id = $_POST['User_ID'];
    $result = addReact($Post_ID,$user_id);
    print_r($result);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'React added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error reacting to post']);
    }

}
if($action == 'getAllUsers'){
    $result = getAllUsers();
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'getUserPosts'){
    $user_id = $_POST['userID'];
    $session_id= $_POST['sessionId'];
    session_id($session_id);
    session_start();
    $currentUser_id = $_SESSION['userId'];
    $result = getUserPosts($user_id,$currentUser_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}
if($action == 'getUserProfile'){
    $user_id = $_POST['userID'];
    $result = getUser($user_id);
    if ($result) {
        echo $result;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to retrieve Data']);
    }
}