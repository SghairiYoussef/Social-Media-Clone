<!  // Purpose : To check the user and redirect to message.php  >

<?php
session_start();
$_SESSION['to_name']=$_GET['id'];
header('location:message.php');

?>
