<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 19/11/2014
Comments: This page will allow users to edit existing topics.
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
else if ($_SESSION[user_id] != $_POST['authorid'])
{
    echo "Fatal error: Your user ID does not match our records."; //form data does not match session data
}
else
{
*/      
      if (!isset($_GET['topicid']) || !isset($_GET['authorid']) || !isset($_GET['content']))
	  {
	      exit("Missing input!"); //stop script
	  }
	  else if (!commentlength($_GET["content"], 50, 5000)) //check length of sent comment
	  {
	  exit("Error: Content is not long enough. Must be over 50 characters, and under 5000."); //stop script
	  }
	  else
	  {
			/* Catch content from HTML form, and format appropriately */
			$topic = strip_tags($_GET['topicid']); 
			$author = strip_tags($_GET['authorid']); 
			$content = strip_tags($_GET['content']); 
			/* End user input */
			$query = "UPDATE Topic SET Content= ? WHERE AuthorID= ? AND TopicID= ?"; //query
			$stmt = mysqli_prepare($db, $query); //prepare query
			if (!mysqli_stmt_bind_param($stmt, 'ssi', $content, $author, $topic)) //define parameters 
			{
				exit('Error: '.mysqli_stmt_error($stmt));
			}
			else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
			{
				exit('Error: '.mysqli_stmt_error($stmt));
			}
			else
			{
				printf("%d topic modified successfully.", mysqli_stmt_affected_rows($stmt)); //success
			}
			mysqli_stmt_close($stmt); //close prepared statement
			mysqli_close ($db); //close database connection
		}
	
//}//
?>
