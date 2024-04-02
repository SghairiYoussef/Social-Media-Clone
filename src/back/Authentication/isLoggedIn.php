<?php
function isLoggedIn()
{
    if(isset($_SESSION['loggedIn'])){
        return true;
    }
    $result=isset($_COOKIE['rememberMe']);
    if($result) {
        $token = $_COOKIE['rememberMe'];
        $result = checkToken('userdata', $token, 'rememberMeToken');
        if ($result) {
            $userData = getUserData('userdata', 'rememberMeToken', $token);
            $_SESSION['userId'] = $userData['userID'];
            $_SESSION['email'] = $userData['email'];
            $_SESSION['loggedIn'] = true;
            return true;
        } else {
            return false;
        }
    }
    return false;



}
?>