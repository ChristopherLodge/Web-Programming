CREATE TABLE User
(
FacebookUserID varchar(128) NOT NULL,
FirstName varchar(20) NOT NULL,
LastName varchar(20) NOT NULL,
Email varchar(40) NOT NULL,
MemberSince TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (FaceBookUserID)
) 
ENGINE = InnoDB;
