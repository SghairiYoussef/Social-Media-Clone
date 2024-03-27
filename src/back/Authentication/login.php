<?php
include "DataBase.php";
function logIn($table, $username, $password)
{
    $connexion = ConnexionBD::getInstance(); // Get database connection instance
    $user_name = $connexion->quote($username);
    $sql = "SELECT * FROM $table WHERE username = $user_name";
    $stmt = $connexion->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $dbusername = $row['userName'];
        $dbpassword = $row['password'];

        if ($dbusername == $username && password_verify($password, $dbpassword)) {
            return true;
        }
    }
    return false;
}