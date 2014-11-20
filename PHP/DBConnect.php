<?php
//store outside document root 
	$server = "mysql.ccacolchester.com";
	$user = "christopherl3022";
	$pass = "1433022";
	$db = mysqli_connect($server, $user, $pass, "christopherl3022");		
	if (mysqli_connect_errno())  //connection error handle 
				{
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				  exit();
				}	
?>