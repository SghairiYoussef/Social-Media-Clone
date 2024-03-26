<?php
function addToken($table, $email,$token)
{
    $connexion = ConnexionBD::getInstance();

    $token = $connexion->quote($token);
    $email = $connexion->quote($email);
    $sql = "UPDATE $table SET token=$token WHERE email=$email";
    try {
        $connexion->exec($sql);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}