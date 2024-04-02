<?php

function fetchDetails(){
    $connexion = ConnexionBD::getInstance();
    $id = $_SESSION['userId'];
    $id = $connexion->quote($id);
    $sql = "SELECT username, email, bio, img FROM userData WHERE userID = $id ;";
    $stmt = $connexion->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
?>