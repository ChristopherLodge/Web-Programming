<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This source is for the page which is used to leave comments on other user's webfolios. 
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
 if (!isset($_GET['content']) || !isset($_GET['recipientid']) || !isset($_GET['senderid']))
	 {
		exit("Missing input!"); //stop script
	 }
	else if (!commentlength($_GET["content"], 50, 500)) //check length of sent comment
	{
		exit("Error: Content is not long enough. Must be over 50 characters, and under 500.");
	}
	else if ($_GET['recipientid'] == $_GET['senderid'])
	{
		exit("You cannot comment on your own profile"); //cannot comment on own profile
	}
else
{
	/* Catch content from HTML form, and format appropriately */
	$recipient = strip_tags($_GET['recipientid']); 
	$sender = strip_tags($_GET['senderid']); 
	$content = strip_tags($_GET['content']); 
	/* End user input */

	$query = "INSERT INTO Comment (SenderID, RecipientID, Content) VALUES (?, ?,?)"; //query
	$stmt = mysqli_prepare($db, $query); //prepare query
		if (!mysqli_stmt_bind_param($stmt, 'sss', $sender, $recipient, $content)) //define parameters 
		{
			exit('mysqli error: '.mysqli_error($db));
		}
		else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
		{
			printf('Error: %s.', mysqli_stmt_error($stmt)); 
		}
		else
		{
			printf("%d comment sent successfully.", mysqli_stmt_affected_rows($stmt)); //success
		}
		mysqli_stmt_close($stmt); //close prepared statement
		mysqli_close ($db); //close database connection
}

?>