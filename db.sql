CREATE DATABASE project;

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
CourseCode VARCHAR(10) REFERENCES Courses,
Password VARCHAR(15) 
);

INSERT INTO Professors (Email, CourseCode, Password)
VALUES ('esyu@syr.edu', 'CSE389', 'badpassword');

