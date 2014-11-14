<?php
require_once('DBConnect.php'); //connect to db
require_once('isloggedon.php'); //is user online?
require_once ('commentverify.php');  //check ids and comment

//below code is commented out until registration system is implemented 
/* if (!checkuserstatus ())
{
	//NOT LOGGED IN
	echo "error, not logged on";
}
else if  ($_POST['recipientid'] == $_POST['senderid'])
{
	//cannot comment on own profile
	echo "Error: I'm sorry. You cannot comment on your own profile.";
}
else if ($_SESSION[user_id] != $_POST['senderid'] || inputcheck($_POST['recipientid') || !inputcheck($_POST['senderid'))
{
	echo "Fatal error: Your user ID does not match our records."; //form data does not match session data, or the recipient/sender ids are not valid!
}
else
{
*/
	if (!commentlength($_POST['content'])) //check length of sent comment
	{
	echo "Error: Comment is not long enough. Must be over 100 characters, and less than 5000.";
	}

	/* Catch content from HTML form, and format appropriately */
	$recipient = strip_tags($_POST['recipientid']); 
	$sender = strip_tags($_POST['senderid']); 
	$content = strip_tags($_POST['content']); 
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
//}//
mysqli_close ($db); //close database connection

?>