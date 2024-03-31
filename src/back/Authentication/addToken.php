<?php
function addToken($table, $data,$token,$tokenType)
{
    $connexion = ConnexionBD::getInstance();

    $token = $connexion->quote($token);
    if(isset($data['email'])) {
        $email = $connexion->quote($data['email']);
        $sql = "UPDATE $table SET $tokenType=$token WHERE email=$email";
    }
    elseif(isset($data['username'])){
        $username = $connexion->quote($data['username']);
        $sql = "UPDATE $table SET $tokenType=$token WHERE username=$username";
    }
    try {
        $connexion->exec($sql);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}