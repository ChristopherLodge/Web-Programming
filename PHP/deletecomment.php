<?php
require_once('DBConnect.php'); //connect to db
require_once('isloggedon.php'); //is user online?

if (!checkuserstatus ())
{
	//NOT LOGGED IN
	echo "error, not logged on";
}
else
{
	$commentid = strip_tags($_POST['commentid']); //receive comment ID from selection
	$stmt = mysqli_prepare($db, "DELETE FROM Comment WHERE RecipientID= ? AND CommentID= ?"); //prepare statement
	mysqli_stmt_bind_param($stmt, 'si',  $_SESSION[user_id], $commentid); //define parameters
	mysqli_stmt_execute($stmt); //execute the "safe" statement
}
mysqli_close ($db);
?>