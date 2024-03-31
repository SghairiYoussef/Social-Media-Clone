<?php
function getUsers($currentUserId)
{
    $conn=ConnexionBD::getInstance();
    $currentUser = $conn->quote($currentUserId);
    $sql = "SELECT username FROM userdata where userId != $currentUserId";
    $stmt = $conn->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}