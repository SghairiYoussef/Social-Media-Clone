<?php

function updatePersonalDetails($fullName,$username,$birthDate,$bio,$newPassword){
    $connexion = ConnexionBD::getInstance();
    $id = $_SESSION['userId'];
    
    if ($fullName){
        $fullName = $connexion->quote($fullName);
        $sql = "UPDATE userData SET fullName = $fullName WHERE userId = $id";
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if ($username){
        $username = $connexion->quote($username);
        $sql = "UPDATE userData SET userName = $username WHERE userId = $id";
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if ($birthDate){
        $birthDate = $connexion->quote($birthDate);
        $sql = "UPDATE userData SET birthDay = $birthDate WHERE userId = $id";
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if ($bio){
        $bio = $connexion->quote($bio);
        $sql = "UPDATE userData SET bio = $bio WHERE userId = $id";
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if ($newPassword){
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $newPassword = $connexion->quote($newPassword);
        $sql = "UPDATE userData SET password = $newPassword WHERE userId = $id";
        $stmt = $connexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return true;
}
?>