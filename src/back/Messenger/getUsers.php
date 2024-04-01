<?php
function getUsers($currentUserId)
{
    $conn=ConnexionBD::getInstance();
    $currentUserId = $conn->quote($currentUserId);
    $sql = "SELECT username FROM userdata where userID != $currentUserId";
    $stmt = $conn->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}