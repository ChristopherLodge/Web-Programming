<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This page will allow users to list a new course on their webfolio. 
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
	if (!commentlength($_GET["title"], 5, 100)) //check length of sent comment
	{
		printf ("Error: Title must be at least 5 characters!");
		exit(); //stop script
	}
	else if (!dateverify($_GET['achievedate']) || !commentlength($_GET['achievedate'], 4, 4))
	{
		printf("Error: Date is not recognized");
		exit();
	}
else
{
		/* Catch content from HTML form, and format appropriately */
		$title = strip_tags($_GET['title']); 
		$author = strip_tags($_GET['learnerid']); 
		$date= strip_tags($_GET['achievedate']); 
		$level= strip_tags($_GET['level']); 
		/* End user input */
		$query = "INSERT INTO Course (LearnerID, Title, AchieveDate, AcademicLevel) VALUES (?, ?,?, ?)"; //query
		$stmt = mysqli_prepare($db, $query); //prepare query
		mysqli_stmt_bind_param($stmt, 'ssss', $author, $title, $date, $level); //define parameters 
		if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
		{
			printf('Error: %s.', mysqli_stmt_error($stmt)); //error handling
		}
		else
		{
			printf("%d course added successfully.", mysqli_stmt_affected_rows($stmt)); //shows number of topics created (will always be 1), and success.
		}
		mysqli_stmt_close($stmt); //close prepared statement
	//}//
	mysqli_close ($db); //close database connection
}
?>