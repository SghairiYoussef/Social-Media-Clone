<?php
function getUsers($currentUserId)
{
    $conn=ConnexionBD::getInstance();
    $currentUserId = $conn->quote($currentUserId);
    $sql = "SELECT username, img, userID FROM userdata where userID != $currentUserId and email != 'insatsocialclubadm1n@gmail.com' ";
    $stmt = $conn->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}