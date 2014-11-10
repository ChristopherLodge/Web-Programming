<?php
require_once('DBConnect.php'); //connect to db
require_once('isloggedon.php'); //is user online?

if (!checkuserstatus ())
{
	//NOT LOGGED IN
	echo "error, not logged on";
}
else if  ($_POST['recipientid'] == $_POST['senderid'])
{
	//cannot comment on own profile
	echo "cannot comment on own profile";
}
else if ($_SESSION[user_id] != $_POST['senderid'])
{
	echo "detected hack attempt"; //the comment must be coming from the right person! 
}
else
{
	/* Catch content from HTML form, and format appropriately */
	$recipient = htmlentities($_POST['recipientid']); 
	$sender = htmlentities($_POST['senderid']); 
	$content = htmlentities($_POST['contentid']); 
	/* End user input */
	
	$query = "INSERT INTO Comment (SenderID, RecipientID, Content) VALUES (?, ?,?)"; //query
		$stmt = mysqli_prepare($db, $query); //prepare query
		mysqli_stmt_bind_param($stmt, 'sss', $sender, $recipient, $content); //define parameters (three strings)
	if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement
	{
		printf('Error: %s.', mysqli_stmt_error($stmt)); //error handling
	}
	else
	{
		printf("%d Comment left successfully.", mysqli_stmt_affected_rows($stmt)); //shows number of comments left (will always be 1), and success.
	}
	mysqli_stmt_close($stmt); //close prepared statement
}
mysqli_close ($db); //close database connection
?>