/*CREATE DATABASE csefinal; */

USE project;

CREATE TABLE Courses (
CourseCode VARCHAR(10) PRIMARY KEY,
CourseTitle VARCHAR(25),
Pictures LONGBLOB,
Assignments LONGBLOB,
Links VARCHAR(1000)
);

CREATE TABLE Professors (
Email VARCHAR(25) PRIMARY KEY,
Password VARCHAR(15) 
);

CREATE TABLE ProfClasses(
proClassKey INT PRIMARY KEY AUTO_INCREMENT, 
CourseCode VARCHAR(10) REFERENCES Courses,
 FOREIGN KEY (ProfEmail) REFERENCES Professors(Email)
);

INSERT INTO Professors (Email, CourseCode, Password)
VALUES ('esyu@syr.edu', 'badpassword');

