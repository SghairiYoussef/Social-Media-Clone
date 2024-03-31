<?php

session_start();

// Main function to handle the messenger page
function messengerPage() {
    $rname = "this-is-the-new-chat";

    if (isset($_SESSION['username'])) {
        include "..\DataBase.php";
        $conn = ConnexionBD::getInstance();
        $uname = $_SESSION['username'];

        if (isset($_SESSION['to_name'])) {
            $rname = $_SESSION['to_name'];
            $q = "SELECT * FROM messenger WHERE 1;";
            $res = mysqli_query($conn, $q);
        }

        if ($rname != "this-is-the-new-chat") {
            $queryl = "SELECT DISTINCT * FROM messenger WHERE to_name='$uname' OR from_name='$uname' ORDER BY time DESC;";
            $heading = 'Chats';
        } else {
            $queryl = "SELECT name FROM users WHERE 1;";
            $heading = 'New Chats';
        }

        $restl = mysqli_query($conn, $queryl);
        $arr = array();

        while ($row = mysqli_fetch_array($restl)) {
            if ($rname == "this-is-the-new-chat") {
                $arr[] = $row['name'];
            } else {
                $arr[] = $row['to_name'];
                $arr[] = $row['from_name'];
            }
        }

        $arr_dis = array_unique($arr);
        $len = count($arr_dis);
        renderMessengerPage($arr_dis, $heading);
    } else {
        $_SESSION['invalid'] = "You must login first";
        header('location:index.php');
    }
}

// Render the messenger page HTML
function renderMessengerPage($arr_dis, $heading) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Messenger</title>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="refresh" content="60"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function focus() {
                console.log('focus');
                document.getElementById('foc').focus();
            }
        </script>
    </head>
    <body onload="setTimeout(focus, 15000);">
    <nav>Risou Socio
    </nav>

    <div style="margin-top: 50px; width: 100%; display: inline-flex;">
        <div id="chat-list">
            <div id="name-list">
                <div id="heading"><?php echo $heading;?></div>
                <?php foreach ($arr_dis as $value) {
                    if ($value != $_SESSION['username']) { ?>
                        <a href="check.php?id=<?php echo $value; ?>">
                            <div class="tabs"><?php echo $value;?></div>
                        </a>
                    <?php }
                }?>
            </div>
            <a href="check.php?new=this-is-the-new-chat"><div id="new-chat" >New Chat</div></a>
        </div>

        <div id="chats">
            <div id="ref"><b><b><?php if (isset($_SESSION['to_name'])) echo $_SESSION['to_name']; ?></b></b><hr></div>
            <div id="messages">
                <div id="msg">

                </div>
                <div id="foc"></div>
            </div>
            <div id="footer">
                <input id="send-box" name="message" placeholder="Type a message">
                <input id="send" type="submit" name="submit" value="Send">
            </div>
        </div>
        <div id="right-bar">
            <div id="hello-msg"><b><?php echo 'Hello '.$_SESSION['username']; ?><br></b></div>
            <div id="online-list">
                Online Users
                <?php
                $uname = $_SESSION['username'];
                $q = "SELECT name FROM users WHERE online > 0;";
                include "..\DataBase.php";
                $conn = ConnexionBD::getInstance();
                $res = mysqli_query($conn, $q);

                while ($row = mysqli_fetch_array($res)) {
                    if ($row['name'] != $_SESSION['username']) { ?>
                        <a href="check.php?id=<?php echo $row['name']; ?>">
                            <div class="online-tabs"><?php echo $row['name'];?></div>
                        </a>
                    <?php }
                }?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#send').click(function(){
                var msg = $.trim($('#send-box').val());
                console.log('done');
                $.ajax({
                    url: "send.php",
                    method: "POST",
                    data: {message: msg},
                    dataType: "text",
                    success: function(data){
                        $('#send-box').val("");
                    }
                });
            });
            setInterval(function(){
                $('#msg').load("fetch.php").fadeIn("slow");
            }, 2000);
        });
    </script>
    </body>
    </html>
    <?php
}

// Call the main messenger function
messengerPage();

?>
