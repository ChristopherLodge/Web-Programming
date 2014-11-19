<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 19/11/2014
Comments: This page will allow users to delete their own account. 
*/
require_once('../DBConnect.php'); //connect to db
require_once('isloggedon.php'); //is user online?
require_once ('verify.php');  //check ids and comment

//below code is commented out until registration system is implemented 
/* if (!checkuserstatus ())
{
	//NOT LOGGED IN
	echo "error, not logged on";
}
else if ($_SESSION[user_id] != $_POST['userid'])
{
	echo "Fatal error: Your user ID does not match our records."; //form data does not match session data
}
else
{*/
		if (!isset($_GET['userid']))
		{
			exit("Missing input!"); //stop script
		}
		else
		{
			/*catch user input*/
			$userid = strip_tags($_GET['userid']); 
			/* End user input */
			$query = "DELETE FROM User WHERE FacebookUserID = ?"; //query
			$stmt = mysqli_prepare($db, $query); //prepare query	
			if (!mysqli_stmt_bind_param($stmt, 's', $userid)) //define parameters 
			{
				exit('mysqli error: '.mysqli_error($db));
			}
			else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
			{
				printf('Error: %s.', mysqli_stmt_error($stmt)); 
			}
			else
			{
				printf("Your account was deleted successfully."); //success
			}
			//must delete session data also
			mysqli_stmt_close($stmt); //close prepared statement
			mysqli_close ($db); //close database connection
		}
?>