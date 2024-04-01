<?php


// Function to send a message
function send($message) {
    $conn = ConnexionBD::getInstance();
    // Get data from session and POST request
    $from_name = getUsername();
    $to_name = $_SESSION['to_name'];

    // Ensure message and recipient are not empty
    if (!empty($message) && !empty($to_name)) {
        // Prepare the SQL statement with placeholders
        $from_name = $conn->quote($from_name);
        $to_name = $conn->quote($to_name);
        $message = $conn->quote($message);
        // Insert the message into the database
        $sql = "INSERT INTO messenger (from_name, to_name, message,time) VALUES ($from_name, $to_name, $message,NOW())";
       try{
            $conn->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
    }
    } else {
        return false;
    }
}
?>