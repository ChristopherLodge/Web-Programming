SELECT CONCAT(FirstName," ", LastName) AS Name, DATE_FORMAT(MemberSince, '%d %b %y') AS RegistrationDate
From User
ORDER BY RegistrationDate DESC

