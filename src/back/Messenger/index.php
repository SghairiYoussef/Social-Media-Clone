<?php
session_start();
include 'connection.php';

if(!isset($_SESSION['username']))
{
?>
<!DOCTYPE html>
<html style="zoom:150%;">
  <head>
    <meta charset="utf-8">
    <title>Log In or Sign Up</title>
    <link rel="stylesheet" type="text/css" href="styling.css">
    <link rel="shortcut icon" href="./webimages/icon.jpg">

  </head>
  <body>
  <nav>
     <div>
    Risou Socioraszebi
     </div>
   </nav>
     
      <div id="heading2">
      <h1 align="center">Please enter your details</h1>
       <h3 style="color: red;" align="center" ><?php if(isset($_SESSION['invalid']))
       echo $_SESSION['invalid']?></h3>
  
        </div>
      <div>  
      <section class="login-form">
        <h2 align ="center" style="font-family: 'Freight Sans', Helvetica, Arial, sans-serif; font-size:19px; color:rgb(59,89,152);">Sign In</h2>
      <form accept-charset="UTF-8" action="validate.php" id="loginForm" method="post" name="loginForm">
      <div>
      
          <input  name="login" placeholder="Username"  type="text" >
        
          <input name="password" placeholder="Password" type="password" >
         
          <input id="button" name="commit"  type="submit" value="Sign In" ">
     </form> 
      </section>
  
        
             <section class="sign-up-form">
                <div id="write-up">
                    
                     <h2 style="font-family: 'Freight Sans', Helvetica, Arial, sans-serif; font-size:19px; color:rgb(59,89,152); " align="center">Sign up</h2>
                </div>

         <form method="post" action="sign_login_add.php">
              <input type="text" name="fname" value="" placeholder="Username">
              <input type="password" name="pass" value="" placeholder="Password">
              <input  id="button" type="submit" value="Sign Up">
         </form>
        </section>
      </div>
  </body>
</html>
<?php
}
else
{
  header('LOCATION:message.php');
}
?>

