<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This page will allow users to delete a topic from their webfolio.
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
else if ($_SESSION[user_id] != $_POST['learnerid'])
{
	echo "Fatal error: Your user ID does not match our records."; //form data does not match session data
}
else
{
*/
		if (!isset($_GET['topicid']) || !isset($_GET['userid']))
		{
			exit("Missing input!"); //stop script
		}
		 else if (!inputcheck($_GET['topicid']))
		{
			printf("Invalid topic ID specified"); //comment id must be integer
		}
		else
		{
			/* Catch content from HTML form, and format appropriately */
			$userid = strip_tags($_GET['userid']); 
			$topicid = strip_tags($_GET['topicid']); 
			/* End user input */
			$query = "DELETE FROM Topic WHERE AuthorID= ? AND TopicID= ?"; //query
			$stmt = mysqli_prepare($db, $query); //prepare query
			if (!mysqli_stmt_bind_param($stmt, 'si', $userid, $topicid)) //define parameters 
			{
				exit('mysqli error: '.mysqli_error($db));
			}
			else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
			{
				printf('Error: %s.', mysqli_stmt_error($stmt)); 
			}
			else
			{
				printf("%d topic deleted successfully.", mysqli_stmt_affected_rows($stmt)); //success
			}
			mysqli_stmt_close($stmt); //close prepared statement
			mysqli_close ($db); //close database connection
		}
//}//
?>