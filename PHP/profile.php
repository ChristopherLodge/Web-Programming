<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This script will act as the core for a profile system. It will select all data pertaining to each user's webfolio to be displayed on the page.
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
*/
	if (!inputcheck($_GET['profileid']))
	{
		printf("Invalid profile ID specified"); //profileid must be numerical 
	}
	else
	{
		$profileid = $_GET['profileid'];
		/*User Details */
		$query = "SELECT CONCAT(User.FirstName,' ', User.LastName) AS Name, DATE_FORMAT(User.MemberSince, '%d %b %y') AS RegistrationDate FROM User WHERE FacebookUserID = ?"; //query
		$stmt = mysqli_prepare($db, $query); //prepare query
		mysqli_stmt_bind_param($stmt, 's', $profileid); //define parameters 
		if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
		{
			printf('Error: %s.', mysqli_stmt_error($stmt)); //error handling
		}
		mysqli_stmt_bind_result($stmt, $name, $registrationdate); //bind results to variables
		$jsonresult=array(); //create array for variables
		while (mysqli_stmt_fetch($stmt))  //create associative array of records 
		{
			$jsonresult[]=array("Name"=>$name, "RegistrationDate"=>$registrationdate);
		}
		echo json_encode($jsonresult); 
		/*End User Details */
		/*Qualifications*/
		$query = "SELECT Title, AchieveDate, AcademicLevel FROM Course WHERE LearnerID = ?"; //query
		$stmt = mysqli_prepare($db, $query); //prepare query
		mysqli_stmt_bind_param($stmt, 's', $profileid); //define parameters 
		if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
		{
			printf('Error: %s.', mysqli_stmt_error($stmt)); //error handling
		}
		mysqli_stmt_bind_result($stmt, $title, $date, $level); //bind results to variables
		$jsonresult=array(); //create array for variables
		while (mysqli_stmt_fetch($stmt))  //create associative array of records 
		{
		$jsonresult[]=array("Title"=>$title, "AchieveDate"=>$date, "AcademicLevel"=>$level);
		}
		echo json_encode($jsonresult); 
		/*End Qualification */
		mysqli_stmt_close($stmt); //close prepared statement
		mysqli_close ($db); //close database connection
	}
?>