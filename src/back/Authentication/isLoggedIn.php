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
            $_SESSION['loggedIn'] = true;
            return true;
        } else {
            return false;
        }
    }
    return false;



}
?>