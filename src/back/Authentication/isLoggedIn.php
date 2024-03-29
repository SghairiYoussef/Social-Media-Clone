<?php
function isLoggedIn()
{
    if(isset($_SESSION['loggedIn'])){
        return true;
    }
    $result=isset($_COOKIE['rememberMe']);
    if($result) {
        $token = $_COOKIE['rememberMe'];
        $result = checkToken('users', $token, 'rememberMeTok
        en');
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