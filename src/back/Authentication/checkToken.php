<?php
function checkToken($table, $token, $tokenType)
{
    $connexion = ConnexionBD::getInstance();
    $token = $connexion->quote($token);
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE $tokenType=$token";
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
