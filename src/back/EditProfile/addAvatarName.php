<?php

function addAvatarName($fileName, $userId){
    $connexion = ConnexionBD::getInstance();
    $fileName = $connexion->quote($fileName);
    $sql = "update userData set image = $fileName where userId = $userId";
    $stmt = $connexion->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        return true;
    }else{
        return false;
    }
}
?>