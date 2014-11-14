<?php
function commentlength(str)
{
	length = strlen($str);  //check length of input string
	if (length < 100 || length > 5000) //if its smaller than 100 chars, or over 5000
	{
		return false; 
	}
	else 
	{
		return true
	}
}

function  inputcheck(number)
{
	$pattern = "^[0-9]*$"; //must begin and end with number, and only contain umbers
	return preg_match($pattern,$number); //compare number to pattern
}
?>