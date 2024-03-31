<?php
function getUserId($table,$attribute,$value)
{
    $connexion = ConnexionBD::getInstance(); // Get database connection instance
    $value = $connexion->quote($value);
    $sql = "SELECT userID FROM $table WHERE $attribute = $value";
    $stmt = $connexion->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return $row['userID'];
    }
}