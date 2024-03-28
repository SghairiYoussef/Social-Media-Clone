<?php
function setRememberMe($table, $username)
{
    //prepare the cookie parameters
    $token = generateToken();
    $expiry = time() + 60 ;

    //set the cookie
    setcookie('rememberMe', $token, $expiry);

    //add the token to the database
    $data = ['username' => $username];
    $result = addToken($table, $data, $token, 'rememberMeToken');

    return $result;

}