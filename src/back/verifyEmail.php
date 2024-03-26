<?php
function verifyEmail($table, $email)
{
    // Get database connection instance
    $connexion = ConnexionBD::getInstance();

    $unqoted_email = $email;
    // Quote the variables to prevent SQL injection
    $email = $connexion->quote($email);

    // Check if username or email already exists
    $checkSql = "SELECT COUNT(*) AS count FROM $table WHERE email = $email";
    $stmt = $connexion->query($checkSql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        return true;
    }

    return false;
}