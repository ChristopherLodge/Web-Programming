<!-- HTML elements for header --> 
<?php
	require_once('DBConnect.php'); //connect to db
	require_once('isloggedin.php'); //is user online?
	require_once('randomprofile.php'); //needed for random user image
	
	if (!checkuserstatus ()) //user is not online! 
	{
?>
		<!-- Put Guest HTML header here and login/register button--> 
<?php 
	}
	else
	{
		$name = $_SESSION['name']; //logged in user, set their name as variable! 
		?>
		<!-- Registered HTML bar here, and say hello to user -->
		<?php 
	}
?>
<!-- Html, including random profile image front-end! -->