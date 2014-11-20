<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This script will select a random entry from the user table, and output the user id for use as a url parameter. 
*/
function randomprofile() //selects a random facebook user id for random image on index
{
	require_once('../DBConnect.php'); //connect to db
	$query ="SELECT FacebookUserID FROM `User` WHERE FacebookUserID >= (SELECT FLOOR( MAX(FacebookUserID) * RAND()) FROM `User` ) ORDER BY FacebookUserID LIMIT 1"; //selects a random (and rounded) entry from the total listings in the table. It will only select one. 
	if (!mysqli_query($db, $query)) //if query fails
				{
					printf("Error message: %s", mysqli_error($db)); //show error
					mysqli_close($db); //close link
					exit(); //discontinue script
				}
				$result = mysqli_query($db, $query);  //set result
				$row = mysqli_fetch_array($result); //convert to array
				$imageid = $row[0]; //user-friendly naming convention
				echo $imageid; //prints the id for use in a url
				mysqli_close($db); //close link
}
?>