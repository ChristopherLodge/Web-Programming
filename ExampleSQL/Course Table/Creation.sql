CREATE TABLE Course
(
CourseID integer NOT NULL AUTO_INCREMENT,
Title varchar(40) NOT NULL,
AchieveDate date NOT NULL,
AcademicLevel varchar(40) NOT NULL,
LearnerID varchar(128) NOT NULL,
PRIMARY KEY (CourseID)
) 
ENGINE = InnoDB;
