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
            $userID = getUserId('userdata', 'rememberMeToken', $token);
            $_SESSION['userID'] = $userID;
            $_SESSION['loggedIn'] = true;
            return true;
        } else {
            return false;
        }
    }
    return false;



}
?>