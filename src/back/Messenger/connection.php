<!  // Purpose: Connection to the database.  >

<?php
$servername="localhost";
$username="root";
$password="";
$database="messenger";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
	die('Error'.mysqli_connect_error());
}
?>
