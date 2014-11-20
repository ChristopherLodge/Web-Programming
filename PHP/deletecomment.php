<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 16/11/2014
Comments: This page will allow users to delete comments left on their own profile. 
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
else if ($_SESSION[user_id] != $_POST['profileid'])
{
	echo "Fatal error: Your user ID does not match our records."; //form data does not match session data
}
else
{*/
		if (!isset($_GET['commentid']) || !isset($_GET['profileid']))
		{
			exit("Missing input!"); //stop script
		}
		 else if (!inputcheck($_GET['commentid']))
		{
			printf("Invalid comment ID specified"); //comment id must be integer
		}
		else
		{
			/*catch user input*/
			$userid = strip_tags($_GET['profileid']); 
			$commentid = strip_tags($_GET['commentid']); 
			/* End user input */
			$query = "DELETE FROM Comment WHERE RecipientID = ? AND CommentID= ?"; //query
			$stmt = mysqli_prepare($db, $query); //prepare query	
			if (!mysqli_stmt_bind_param($stmt, 'si', $userid, $commentid)) //define parameters 
			{
				 exit('Error: '.mysqli_stmt_error($stmt));
			}
			else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
			{
				 exit('Error: '.mysqli_stmt_error($stmt));
			}
			else
			{
				printf("%d comment deleted successfully.", mysqli_stmt_affected_rows($stmt)); //success
			}
			mysqli_stmt_close($stmt); //close prepared statement
			mysqli_close ($db); //close database connection
		}
?>