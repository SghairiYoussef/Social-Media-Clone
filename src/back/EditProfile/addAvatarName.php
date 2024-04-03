<?php

function addAvatarName($fileName, $userId){
    $connexion = ConnexionBD::getInstance();
    $fileName = $connexion->quote($fileName);
    $userId = $connexion->quote($userId);
    $sql = "update userData set img = $fileName where userId = $userId";
    try{
        $connexion->exec($sql);
        return true;
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
?>