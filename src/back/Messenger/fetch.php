<?php
function displayMessages() {
    // Include the database connection file
    $conn = ConnexionBD::getInstance();

    // Get the current user's username from the session
    $uname = getUsername();

    // Check if a recipient is selected
    if (isset($_SESSION['to_name'])) {
        $rname = $_SESSION['to_name'];

        // Query to fetch messages between the current user and the selected recipient
        $q = "SELECT * FROM messenger WHERE (from_name='$uname' AND to_name='$rname') OR (from_name='$rname' AND to_name='$uname ') ORDER BY time";
        $stmt = $conn->query($q);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } else {
        // No recipient selected
        return false;
    }
}
?>