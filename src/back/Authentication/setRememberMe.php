<?php
function setRememberMe($table, $username)
{
    //prepare the cookie parameters
    $token = generateToken();
    $expiry = time() + (60*60*24);

    //set the cookie
    $result = setcookie('rememberMe', $token, $expiry, '/','localhost');
    if ($result){
        //add the token to the database
        $data = ['username' => $username];
    $result = addToken($table, $data, $token, 'rememberMeToken');
    return $result;
}
else
{
    return false;
}
}