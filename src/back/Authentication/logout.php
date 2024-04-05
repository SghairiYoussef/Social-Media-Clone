<?php
function logout($username)
{
    $result = setStatus($username, 'Offline');
    $result=setcookie('rememberMe', '', time() - 3600, '/','localhost');
    $connexion = ConnexionBD::getInstance();
    $username = $connexion->quote($username);
    $sql = "update userData set rememberMeToken = null where username = $username";
    $result = $connexion->query($sql);
    if($result){
        $result =session_destroy();
        return $result;
    }
    return false;
}