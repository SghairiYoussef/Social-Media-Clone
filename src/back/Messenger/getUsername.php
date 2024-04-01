<?php

function getUsername() {
    // Include the database connection file
    $conn = ConnexionBD::getInstance();

    // Get the current user's username from the session
    $id = $_SESSION['userId'];
    $id = $conn->quote($id);

    // Query to fetch online users
    $q = "SELECT name FROM userData WHERE userId = $id ;";
    $res = mysqli_query($conn, $q);

    $row = mysqli_fetch_array($res);
    return $row['username'];
}

?>
