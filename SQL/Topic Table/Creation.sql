CREATE TABLE Topic
(
TopicID integer NOT NULL AUTO_INCREMENT,
AuthorID varchar(128) NOT NULL,
Title varchar(30) NOT NULL,
Content text(5000) NOT NULL,
DatePosted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (TopicID)
) 
ENGINE = InnoDB;
