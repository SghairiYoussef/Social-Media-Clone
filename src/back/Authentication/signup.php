<?php
function signup($table, $fullname, $email, $username, $password, $birthDate)
{
    $connexion = ConnexionBD::getInstance();

    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Quote the variables to prevent SQL injection
    $fullname = $connexion->quote($fullname);
    $email = $connexion->quote($email);
    $username = $connexion->quote($username);

    $password = $connexion->quote($password);
    $birthDate = $connexion->quote($birthDate);
    // Insert user data into the database
    $sql = "INSERT INTO $table (userName, email, password, fullName,birthDay) VALUES ($username,$email,$password,$fullname,$birthDate)";
    try {
        $connexion->exec($sql);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}