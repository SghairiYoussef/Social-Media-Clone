<?php
session_start();
include 'connection.php';

$from_name=$_SESSION['username'];
$message=$_POST['message'];
$to_name=$_SESSION['to_name'];
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d H:i:s');

if(!empty($message))
if(!empty($to_name))
{
$q="insert into messenger (from_name,to_name,message,time) values ('$from_name','$to_name','$message','$current_date') ;";
mysqli_query($conn,$q);

}
//header('location:message.php');
?>