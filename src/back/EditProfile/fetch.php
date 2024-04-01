<?php

function fetchDetails() {
    $connexion = ConnexionBD::getInstance();
    $sql = "SELECT * FROM userdata WHERE userID = :userID";
    $stmt = $connexion->query($sql);
    $result = $stmt->execute(['userID' => $_SESSION['userID']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;;
}
?>