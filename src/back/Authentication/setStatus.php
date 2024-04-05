<?php
function setStatus($username, $value)
{
    $connexion = ConnexionBD::getInstance();
    $username = $connexion->quote($username);
    $value = $connexion->quote($value);
    $sql = "UPDATE UserData SET userStatus = $value WHERE username = $username";
    $stmt = $connexion->query($sql);
    if ($stmt) {
        return true;
    } else {
        return false;
    }
}
?>