<?php
include 'connection.php';  //require
session_start();

$username = $_REQUEST['fname'];
$password= $_REQUEST['pass'];
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d H:i:s');


  if(!(empty($username) || empty($password)))
  {
  		$q=mysqli_query($conn,"select * from users where name='$username'");
  		$stat=mysqli_num_rows($q);
      
  		if($stat==0)
  		{
        $q = "insert into users(name,password,status,online,date_time) VALUES ('$username','$password',1,1,'$current_date');" ;
        $var=mysqli_query($conn,$q);
        
        if($var) {
        	$_SESSION['username']=$username;
            echo $password.$stat;
            $_SESSION['invalid']="";
            $uname=$_SESSION['username'] ;
            echo "done";
            header('location:message.php');
        }
        }
        else{
        	$_SESSION['invalid']="username already exist";
        	header('LOCATION:index.php');


        } 
   }
   else{    

 $_SESSION['invalid']="empty";
  	header('LOCATION:index.php');
  }       
    

mysqli_close($conn);

?>