<?php
function resetPassword($table, $email, $password)
{
    // Get database connection instance
    $connexion = ConnexionBD::getInstance();

    // Quote the variables to prevent SQL injection
    $email = $connexion->quote($email);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $password = $connexion->quote($password);

    // Update the password in the database
    $updateSql = "UPDATE $table SET password = $password WHERE email = $email";
    try {
        $connexion->exec($updateSql);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
