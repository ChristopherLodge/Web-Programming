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
{
	$recipient = mysql_real_escape_string($_POST['recipientid']); //catch receiver from form and escape
	$sender = mysql_real_escape_string($_POST['senderid']); //catch sender from form and escape
	$content = mysql_real_escape_string($_POST['contentid']); //catch content from form and escape

	$stmt = mysqli_prepare($db, "INSERT INTO Comment (SenderID, RecipientID, Content) VALUES (?, ?,?)"); //prepare statement
	mysqli_stmt_bind_param($stmt, 'sss', $sender, $recipient, $content); //define parameters
	mysqli_stmt_execute($stmt); //execute the "safe" statement
}
mysqli_close ( mysqli, $db);
?>