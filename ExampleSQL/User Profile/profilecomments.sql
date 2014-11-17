SELECT Comment.Content, DATE_FORMAT(Comment.DatePosted, '%d %b %y'), CONCAT(User.FirstName,' ', User.LastName) AS SenderName 
FROM Comment 
INNER JOIN 
User ON Comment.SenderID =  User.FacebookUserID 
WHERE Comment.RecipientID  = 723476789