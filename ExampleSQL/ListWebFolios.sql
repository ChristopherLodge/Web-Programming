SELECT CONCAT(User.FirstName,' ', User.LastName) AS Name, DATE_FORMAT(User.MemberSince, '%d %b %y') AS RegistrationDate, Max(Course.AcademicLevel) AS EducationLevel, Min(Course.AchieveDate) AS AchievementDate, Course.Title
FROM User
LEFT JOIN Course
ON User.FacebookUserID = Course.LearnerID
GROUP BY User.FacebookUserID
ORDER BY Course.AcademicLevel DESC, Course.AchieveDate ASC

