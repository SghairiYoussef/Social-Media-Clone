<?php
function addReport($table, $fullName, $email, $message)
{
    $conn= ConnexionBD::getInstance();
    //quote the values
    $fullName = $conn->quote($fullName);
    $email = $conn->quote($email);
    $message = $conn->quote($message);
    $sql = "INSERT INTO $table (fullName, email, message,date) VALUES ($fullName, $email, $message, NOW())";
    try {
        $conn->exec($sql);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}