<?php
function checkToken($table,$email, $token)
{
    $connexion = ConnexionBD::getInstance();
    $email = $connexion->quote($email);
    $token = $connexion->quote($token);
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE email=$email AND token=$token";
    try {
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
{
}