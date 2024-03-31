<?php
function displayMessages() {
    // Include the database connection file
    include "..\DataBase.php";
    $conn = ConnexionBD::getInstance();
    // Start the session
    session_start();

    // Get the current user's username from the session
    $uname = $_SESSION['username'];

    // Check if a recipient is selected
    if (isset($_SESSION['to_name'])) {
        $rname = $_SESSION['to_name'];

        // Query to fetch messages between the current user and the selected recipient
        $q = "SELECT * FROM messenger WHERE (from_name='$uname' AND to_name='$rname') OR (from_name='$rname' AND to_name='$uname')";
        $res = mysqli_query($conn, $q);

        // Loop through the results and display messages
        while ($row = mysqli_fetch_array($res)) {
            if ($row['from_name'] == $uname && $row['to_name'] == $rname) {
                // Message sent by the current user
                ?>
                <div class="sent">
                    <?php echo $row['message']; ?>
                </div>
                <?php
            } elseif ($row['from_name'] == $rname && $row['to_name'] == $uname) {
                // Message received by the current user
                ?>
                <div class="received">
                    <?php echo $row['message']; ?>
                </div>
                <?php
            }
        }
    } else {
        // No recipient selected
        echo "Select somebody to chat with";
    }
}
?>