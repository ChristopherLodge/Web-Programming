<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This page will allow users to delete a course from their webfolio.
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
		if (!isset($_GET['learnerid']) || !isset($_GET['courseid']))
		{
			exit("Missing input!"); //stop script
		}
		else if (!inputcheck($_GET['courseid']))
		{
			printf("Invalid course ID specified"); //course id must be numerical 
		}
		else
		{
			/* Catch content from HTML form, and format appropriately */
				$userid = strip_tags($_GET['learnerid']); 
				$courseid = strip_tags($_GET['courseid']); 
				/* End user input */
				
				$query = "DELETE FROM Course WHERE LearnerID= ? AND CourseID= ?"; //query
				$stmt = mysqli_prepare($db, $query); //prepare query	
				if (!mysqli_stmt_bind_param($stmt, 'si', $userid, $courseid)) //define parameters 
				{
					exit('mysqli error: '.mysqli_error($db));
				}
				else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
				{
					printf('Error: %s.', mysqli_stmt_error($stmt)); 
				}
				else
				{
					printf("%d course deleted successfully.", mysqli_stmt_affected_rows($stmt)); //success
				}
				mysqli_stmt_close($stmt); //close prepared statement
				mysqli_close ($db); //close database connection
		}
//}//
?>