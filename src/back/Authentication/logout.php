<?php
function logout()
{
    $result=setcookie('rememberMe', '', time() - 3600, '/','localhost');
    if($result){
        $result =session_destroy();
        return $result;
    }
    return false;
}