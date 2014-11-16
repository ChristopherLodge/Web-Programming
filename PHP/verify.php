<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 14/11/2014
Comments: This script contains functions used in the validation of information submitted as a topic or comment - enforcement of the length of a message/topic, as well as  verifying numbers
*/
function commentlength($str, $min, $max)
{
	$length = strlen($str);  //check length of input string
	if ($length < $min|| $length > $max) //if its smaller than minimum chars, or over the maximum
	{
		return false;  //fail
	}
	else 
	{
		return true; //success
	}
}

function  inputcheck($number)
{
	$pattern = "^[0-9]*$"; //must begin and end with number, and only contain umbers
	return preg_match($pattern,$number); //compare number to pattern
}
?>