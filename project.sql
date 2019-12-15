-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 02:39 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseCode` varchar(10) NOT NULL,
  `CourseTitle` varchar(25) DEFAULT NULL,
  `Pictures` longblob DEFAULT NULL,
  `Assignments` longblob DEFAULT NULL,
  `Links` varchar(1000) DEFAULT NULL,
  `Department` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseCode`, `CourseTitle`, `Pictures`, `Assignments`, `Links`, `Department`) VALUES
('', '', '', '', '', NULL),
('ECS 102', 'Python Programming', '', '', 'https://ecs.syr.edu/faculty/baruch/ecs102/', 'ECS'),
('YO', 'Web System Architecture a', '', '', 'https://cs.fit.edu/~mmahoney/cse4232/tcpip.html', 'ECS');

-- --------------------------------------------------------

--
-- Table structure for table `profclasses`
--

CREATE TABLE `profclasses` (
  `ProfClassKey` int(11) NOT NULL,
  `CourseCode` varchar(10) NOT NULL,
  `ProfEmail` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profclasses`
--

INSERT INTO `profclasses` (`ProfClassKey`, `CourseCode`, `ProfEmail`) VALUES
(2, 'YO', 'professorYu@syr.edu'),
(3, 'ECS 102', 'professorYu@syr.edu');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `Email` varchar(25) NOT NULL,
  `Password` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`Email`, `Password`) VALUES
('professorYu@syr.edu', 'pass123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseCode`);

--
-- Indexes for table `profclasses`
--
ALTER TABLE `profclasses`
  ADD PRIMARY KEY (`ProfClassKey`),
  ADD KEY `ProfEmail` (`ProfEmail`),
  ADD KEY `CourseCode` (`CourseCode`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profclasses`
--
ALTER TABLE `profclasses`
  MODIFY `ProfClassKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profclasses`
--
ALTER TABLE `profclasses`
  ADD CONSTRAINT `profclasses_ibfk_1` FOREIGN KEY (`ProfEmail`) REFERENCES `professors` (`Email`),
  ADD CONSTRAINT `profclasses_ibfk_2` FOREIGN KEY (`CourseCode`) REFERENCES `courses` (`CourseCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
