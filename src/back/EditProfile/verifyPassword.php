<?php

function verifyPassword($password){
    $connexion = ConnexionBD::getInstance();
    $id = $_SESSION['userId'];
    $sql = "SELECT password FROM userData WHERE userId = $id";
    $stmt = $connexion->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashedPassword = $result['password'];
    if(password_verify($password, $hashedPassword)){
        return false;
    }
    return true;
}
?>