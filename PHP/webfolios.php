<?php
/* 
Author: Christopher Lodge
Student ID: 1433022
Date: 15/11/2014
Comments: This script will list all webfolios (users) present on the website, to be used as a directory to each. 
*/
require_once('../DBConnect.php'); //connect to db
$query = "SELECT CONCAT(User.FirstName,' ', User.LastName) AS Name, DATE_FORMAT(User.MemberSince, '%d %b %y') AS RegistrationDate, Max(Course.AcademicLevel) AS EducationLevel, Min(Course.AchieveDate) AS AchievementDate, Course.Title
FROM User
LEFT JOIN Course
ON User.FacebookUserID = Course.LearnerID
GROUP BY User.FacebookUserID
ORDER BY Course.AcademicLevel DESC, Course.AchieveDate ASC";
if (!mysqli_query($db, $query)) //if query fails
	{
		printf("Error message: %s", mysqli_error($db)); //show error
		mysqli_close($db); //close link
		exit(); //discontinue script
	}
	$result = mysqli_query($db, $query);  //set result
	    $response = array();

    while($row = mysqli_fetch_assoc($result))
    {
        $response[] = $row;
    }
 print json_encode($response);
 //academic level will be converted into FE/HE 
?>