<?php

function verifyUsername($username){
    $connexion = ConnexionBD::getInstance();
    $username = $connexion->quote($username);
    $sql = "SELECT count(*) as count FROM userData WHERE username = $username";
    $stmt = $connexion->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        return true;
    }
    return false;
}
?>