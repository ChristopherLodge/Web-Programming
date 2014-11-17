SELECT CONCAT(User.FirstName,' ', User.LastName) AS Name, DATE_FORMAT(User.MemberSince, '%d %b %y') AS RegistrationDate 
FROM User 
WHERE FacebookUserID = 123456789;