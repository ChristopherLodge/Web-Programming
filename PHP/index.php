<?php
	function checkuserstatus () //session must be started and user_id set to return true! 
	{
		if (isset($_SESSION['user_id'])) 
		{
			echo "logged on"; //user is logged on
			return 1;
		} 
		else 
		{
			echo "not logged on"; //user is logged off
			return 0;
		}
	}
?>