<?php

$conn = ConnexionBD::getInstance();

// Function to send a message
function sendMessage() {
    global $conn;

    // Get data from session and POST request
    $from_name = getUsername($_SESSION['userId']);
    $message = $_POST['message'];
    $to_name = $_SESSION['to_name'];

    // Ensure message and recipient are not empty
    if (!empty($message) && !empty($to_name)) {
        // Prepare the SQL statement with placeholders
        $q = "INSERT INTO messenger (from_name, to_name, message, time) VALUES (?, ?, ?, ?)";

        // Create a prepared statement
        $stmt = mysqli_prepare($conn, $q);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, 'ssss', $from_name, $to_name, $message, $current_date);

        // Get the current date and time
        date_default_timezone_set('Africa/Tunis');
        $current_date = date('Y-m-d H:i:s');

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}
?>