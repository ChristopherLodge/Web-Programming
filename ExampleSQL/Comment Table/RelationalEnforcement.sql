ALTER TABLE Comment
ADD FOREIGN KEY (RecipientID) REFERENCES User(FacebookUserID) ON DELETE CASCADE;

ALTER TABLE Comment
ADD FOREIGN KEY (SenderID) REFERENCES User(FacebookUserID) ON DELETE CASCADE;
