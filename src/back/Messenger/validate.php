<?php
session_start();
include 'connection.php';
$username=$_REQUEST['login'];
$password=$_REQUEST['password'];
if(!(empty($username) || empty($password)))
{
	

$q="Select * from users where name='$username' && password='$password';";

$result=mysqli_query($conn,$q);
$stat=mysqli_fetch_array($result);
$rowcount=mysqli_num_rows($result);
if($rowcount>0)
{

$s=$stat['status'];
$s=$s+1;
mysqli_query($conn,"update users set status='$s' where name='$username';");
$_SESSION['username']=$username;
$_SESSION['invalid']="";
$uname=$_SESSION['username'] ;
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d H:i:s');
$q="Update users set online=1 ,date_time='$current_date' where name='$uname'; ";

mysqli_query($conn,$q);
header('location:message.php');
}
else
{
	$_SESSION['invalid']="wrong username or password";
header("location:sign_login.php");
}
}
   else{    

 $_SESSION['invalid']="empty";
  	header('LOCATION:index.php');
  } 
?>