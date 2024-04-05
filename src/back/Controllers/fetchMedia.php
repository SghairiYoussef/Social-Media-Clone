<?php

function fetchMedia($Post_ID){
    $connexion = ConnexionBD::getInstance();
    $Post_ID = $connexion->quote($Post_ID);
    $sql = "SELECT Media FROM post WHERE Post_ID = $Post_ID ;";
    $stmt = $connexion->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['Media'];
    }
    return false;
}
?>