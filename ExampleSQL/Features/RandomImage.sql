SELECT FacebookUserID FROM `User` WHERE FacebookUserID >= (SELECT FLOOR( MAX(FacebookUserID) * RAND()) FROM `User` ) ORDER BY FacebookUserID LIMIT 1
--selects a single random ID from the User table. 