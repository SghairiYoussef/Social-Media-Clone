<?php
    include "C:\Users\Kacem Mathlouthi\Desktop\messenger-master\connection.php";
	session_start();
	$uname=$_SESSION['username'];
    if (isset($_SESSION['to_name'])) {
        $rname=$_SESSION['to_name'];
        $q="select * from messenger where 1; ";
        $res=mysqli_query($conn,$q);
            while($row = mysqli_fetch_array($res))
               {
                    if($row['from_name']==$uname && $row['to_name']==$rname)
                    {?>
                        <div class="sent">
                        <?php echo $row['message']; ?>
                        </div>
                    <?php
                    }
                    if($row['from_name']==$rname &&
                        $row['to_name']==$uname)
                    {?>
                        <div class="received">
                        <?php echo $row['message']; ?>
                        </div>
                    <?php
                    }
               }
          }
           else
          {echo "Select somebody to chat with";}
        ?><br>


