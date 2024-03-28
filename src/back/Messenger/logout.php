<?php
session_start();
include 'connection.php';
$_SESSION['invalid']="You have successfully logged out";
$uname=$_SESSION['username'] ;
$q="Update users set online=0 where name='$uname'; ";

mysqli_query($conn,$q);
session_destroy();

header('location:index.php');

?>
