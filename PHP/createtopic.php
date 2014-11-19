<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This source is for the page which is create additional topics on a user's webfolio.
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
	 if (!isset($_GET['content']) || !isset($_GET['title']) || !isset($_GET['authorid']))
	 {
		exit("Missing input!"); //stop script
	 }
	else if (!commentlength($_GET["content"], 50, 5000) || !commentlength($_GET["title"], 5, 100)) //check length of sent comment
	{
	exit("Error: Content is not long enough. Must be over 50 characters, and under 5000; while the title must be at least 5 characters in length.");
	}
	else
	{
		/* Catch content from HTML form, and format appropriately */
		$title = strip_tags($_GET['title']); 
		$author = strip_tags($_GET['authorid']); 
		$content = strip_tags($_GET['content']); 
		/* End user input */
		
		$query = "INSERT INTO Topic (AuthorID, Title, Content) VALUES (?, ?,?)"; //query
		$stmt = mysqli_prepare($db, $query); //prepare query
		if (!mysqli_stmt_bind_param($stmt, 'sss', $author, $title, $content)) //define parameters 
		{
			exit('mysqli error: '.mysqli_error($db));
		}
		else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
		{
			printf('Error: %s.', mysqli_stmt_error($stmt)); 
		}
		else
		{
			printf("%d topic created successfully.", mysqli_stmt_affected_rows($stmt)); //success
		}
		mysqli_stmt_close($stmt); //close prepared statement
		mysqli_close ($db); //close database connection
	}
?>