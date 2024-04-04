<?php

function fetchAvatar($userId){
    $connexion = ConnexionBD::getInstance();
    $userId = $connexion->quote($userId);
    $sql = "SELECT img FROM userData WHERE userID = $userId ;";
    $stmt = $connexion->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['img'];
    }
    return false;
}
?>