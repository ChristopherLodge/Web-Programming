<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This script will act as the core for a profile system. It will select all data pertaining to each user's webfolio to be displayed on the page.
*/
require_once('../DBConnect.php'); //connect to db
require_once('isloggedon.php'); //is user online?
//below code is commented out until registration system is implemented 
/* if (!checkuserstatus ())
{
	//NOT LOGGED IN
	echo "error, not logged on";
}
else
{
*/	
if (!isset($_GET['profileid']))
		{
			exit("Missing input!"); //stop script
		}
else
{
	$profileid = $_GET['profileid']; //pull profile id of target user from form
	/* User Details */
	$query = "SELECT CONCAT(User.FirstName,' ', User.LastName) AS Name, DATE_FORMAT(User.MemberSince, '%d %b %y') AS RegistrationDate FROM User WHERE FacebookUserID = ?"; //query
	$stmt = mysqli_prepare($db, $query); //prepare query
	if (!mysqli_stmt_bind_param($stmt, 's', $profileid)) //define parameters 
	{
		exit('Error: '.mysqli_stmt_error($stmt));
	}
	if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
	{
		exit('Error'.mysqli_stmt_error($stmt));
	}
	if (!mysqli_stmt_bind_result($stmt, $name, $registrationdate)) //bind results to variables
	{
		exit('Error: '.mysqli_stmt_error($stmt));
	}
	
	$userjson=array(); //create array for variables
	while (mysqli_stmt_fetch($stmt))  //create associative array of records 
	{
		$userjson[]=array("Name"=>$name, "RegistrationDate"=>$registrationdate);
	}
	echo json_encode($userjson); 
	mysqli_stmt_close($stmt); //close prepared statement
	/*End User Details */
	/*Course Details*/
	$query = "SELECT Title, AchieveDate, AcademicLevel FROM Course WHERE LearnerID = ?"; //query
	$stmt = mysqli_prepare($db, $query); //prepare query
	if (!mysqli_stmt_bind_param($stmt, 's', $profileid)) //define parameters 
	{
		exit('Error: '.mysqli_stmt_error($stmt));
	}
	if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
	{
		exit('Error: '.mysqli_stmt_error($stmt)); //error handling
	}
	if (!mysqli_stmt_bind_result($stmt, $title, $date, $level)) //bind results to variables
	{
		exit('Error: '.mysqli_stmt_error($stmt)); //error handling
	}
	$coursejson=array(); //create array for variables
	while (mysqli_stmt_fetch($stmt))  //create associative array of records 
	{
		$coursejson[]=array("Title"=>$title, "AchieveDate"=>$date, "AcademicLevel"=>$level);
	}
	echo json_encode($coursejson); 
	mysqli_stmt_close($stmt); //close prepared statement
	/*End Course Details */
	/*Topic Details*/
	$query = "SELECT Title, DatePosted, Content FROM Topic WHERE AuthorID = ?"; //query
	$stmt = mysqli_prepare($db, $query); //prepare query
	if (!mysqli_stmt_bind_param($stmt, 's', $profileid)) //define parameters 
	{
		exit('Error: '.mysqli_stmt_error($stmt));
	}
	if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
	{
		exit('Error: '.mysqli_stmt_error($stmt)); //error handling
	}
	if (!mysqli_stmt_bind_result($stmt, $title, $date, $content)) //bind results to variables
	{
		exit('Error: '.mysqli_stmt_error($stmt)); //error handling
	}
	$topicjson=array(); //create array for variables
	while (mysqli_stmt_fetch($stmt))  //create associative array of records 
	{
		$topicjson[]=array("Title"=>$title, "DatePosted"=>$date, "Content"=>$content);
	}
	echo json_encode($topicjson);
	mysqli_stmt_close($stmt); //close prepared statement	
	/*End Topic Details */
	/*Comment Details*/
	$query = "SELECT Comment.Content, DATE_FORMAT(Comment.DatePosted, '%d %b %y'), CONCAT(User.FirstName,' ', User.LastName) AS SenderName FROM Comment INNER JOIN User ON Comment.SenderID =  User.FacebookUserID WHERE Comment.RecipientID  = ?"; //query
	$stmt = mysqli_prepare($db, $query); //prepare query
	if (!mysqli_stmt_bind_param($stmt, 's', $profileid)) //define parameters 
	{
		exit('Error: '.mysqli_stmt_error($stmt));
	}
	if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
	{
		exit('Error: '.mysqli_stmt_error($stmt)); 
	}
	if (!mysqli_stmt_bind_result($stmt, $content, $date, $from)) //bind results to variables
	{
		exit('Error: '.mysqli_stmt_error($stmt));
	}
	$commentjson=array(); //create array for variables
	while (mysqli_stmt_fetch($stmt))  //create associative array of records 
	{
		$commentjson[]=array("From"=>$from, "DatePosted"=>$date,"Content"=>$content);
	}
	echo json_encode($commentjson); 
	mysqli_stmt_close($stmt); //close prepared statement
	/*End Comment Details */
	mysqli_close ($db); //close database connection
}
?>