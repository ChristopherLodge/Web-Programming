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
	echo "detected hack attempt";
}
else
{
	$recipient = htmlentities($_POST['recipientid']); //catch receiver from form and strip html
	$sender = htmlentities($_POST['senderid']); //catch sender from form and strip html
	$content = htmlentities($_POST['contentid']); //catch content from form and strip html

	$stmt = mysqli_prepare($db, "INSERT INTO Comment (SenderID, RecipientID, Content) VALUES (?, ?,?)"); //prepare statement
	mysqli_stmt_bind_param($stmt, 'sss', $sender, $recipient, $content); //define parameters
	mysqli_stmt_execute($stmt); //execute the "safe" statement
}
mysqli_close ($db);
?>