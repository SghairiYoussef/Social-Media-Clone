<?php

function getUsername() {
    // Include the database connection file
    $conn = ConnexionBD::getInstance();

    // Get the current user's username from the session
    $id = $_SESSION['userId'];
    $id = $conn->quote($id);

    // Query to fetch online users
    $q = "SELECT username FROM userData WHERE userId = $id ;";
    $stmt = $conn->query($q);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['username'];
}

?>
