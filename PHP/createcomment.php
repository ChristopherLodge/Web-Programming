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
	$recipient = htmlentities($_POST['recipientid']); //catch receiver from form and strip html
	$sender = htmlentities($_POST['senderid']); //catch sender from form and strip html
	$content = htmlentities($_POST['contentid']); //catch content from form and strip html

	$stmt = mysqli_prepare($db, "INSERT INTO Comment (SenderID, RecipientID, Content) VALUES (?, ?,?)"); //prepare statement
	
	if (!mysqli_stmt_bind_param($stmt, 'sss', $sender, $recipient, $content)) //define parameters
	{
		echo "binding failed"; //investigate if correct/for error command
		exit();
	}
	else if (!mysqli_stmt_execute($stmt)) //execute the "safe" statement, print error if any
	{
		echo "failure"; //investigate if correct/ for error command
		exit();
	}

}
mysqli_close ($db);
?>