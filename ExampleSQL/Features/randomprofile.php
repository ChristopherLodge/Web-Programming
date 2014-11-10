<?php
function randomprofile()
require_once('DBConnect.php');
{
	if (mysqli_connect_errno()) 
				{
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				  exit();
				}	
	$query ="SELECT * FROM `User` WHERE FacebookUserID >= (SELECT FLOOR( MAX(FacebookUserID) * RAND()) FROM `User` ) ORDER BY FacebookUserID LIMIT 1"; //double check
	if (!mysqli_query($db, $query))
				{
					printf("Error message: %s\n", mysqli_error($db)); //show error
					mysqli_close($db); //close link
					exit(); //discontinue script
				}
				$result = mysqli_query($db, $query); 
				echo $result;
}
?>