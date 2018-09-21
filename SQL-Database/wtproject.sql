-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2018 at 12:31 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wtproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `EmpID` char(15) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Designation` varchar(15) NOT NULL,
  `cc_of` varchar(4) DEFAULT NULL,
  `mentor_of` char(3) DEFAULT NULL,
  `HintQ` tinytext NOT NULL,
  `Answer` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`EmpID`, `Password`, `Name`, `Designation`, `cc_of`, `mentor_of`, `HintQ`, `Answer`) VALUES
('EMP123456789000', 'Asdfghjkl1', 'Professor1', '3', 'TE6', 'N6', '1', 'Sangat'),
('EMP4119', 'Asdfghjkl1', 'HeadOfComp', '2', '', '', '2', 'google'),
('O138', 'Asdfghjkl1', 'Staff1', '4', '', 'H2', '2', 'tcs');

-- --------------------------------------------------------

--
-- Table structure for table `StaffApps`
--

CREATE TABLE `StaffApps` (
  `AppID` int(11) NOT NULL,
  `EmpID` char(15) NOT NULL,
  `LeaveAddr` mediumtext NOT NULL,
  `LeaveContact` char(10) NOT NULL,
  `Reasons&Dates` longtext NOT NULL,
  `ltype` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending Approval'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StaffApps`
--

INSERT INTO `StaffApps` (`AppID`, `EmpID`, `LeaveAddr`, `LeaveContact`, `Reasons&Dates`, `ltype`, `status`) VALUES
(2, 'EMP123456789000', 'asdfghjkl', '8421869612', '04/11/2018 - Full Day\r\n\nqwertyuiop', 'ML', 'Disapproved'),
(3, 'O138', 'as per record', '1234567890', '04/16/2018 - Full Day\r\n04/03/2018 - Half Day\r\n\npersonal', 'EL', 'Approved'),
(4, 'EMP123456789000', 'B2, Bharadwaj Nagar, Nashik', '9130158758', '04/11/2018 - Full Day\r\n04/12/2018 - Full Day\r\n04/13/2018 - Full Day\r\n04/14/2018 - Full Day\r\n04/16/2018 - Full Day\r\n04/17/2018 - Full Day\r\n04/18/2018 - Half Day\r\n\nRegretful passing of a relative', 'LWP', 'Disapproved');

-- --------------------------------------------------------

--
-- Table structure for table `StudApps`
--

CREATE TABLE `StudApps` (
  `AppID` int(11) NOT NULL,
  `ID` char(15) NOT NULL,
  `cc_id` char(15) NOT NULL,
  `mentor_id` char(15) NOT NULL,
  `Reasons&Dates` longtext NOT NULL,
  `LeaveAddr` mediumtext NOT NULL,
  `LeaveContact` char(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending Approval'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StudApps`
--

INSERT INTO `StudApps` (`AppID`, `ID`, `cc_id`, `mentor_id`, `Reasons&Dates`, `LeaveAddr`, `LeaveContact`, `status`) VALUES
(4, 'C2K15105154', 'EMP123456789000', 'O138', '04/18/2018-04/21/2018\nNot well. Chicken Pox', 'Flat No. 8, Priyal Vihar Hostel, Opp. Amir Chicken Centre, Dhankawadi, Pune', '8421869612', 'Disapproved');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `EnrollID` char(15) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Class` varchar(4) NOT NULL,
  `Batch` char(3) NOT NULL,
  `Mentor` char(15) NOT NULL,
  `ClassCordinator` char(15) NOT NULL,
  `HintQ` tinytext NOT NULL,
  `Answer` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`EnrollID`, `Password`, `Name`, `Class`, `Batch`, `Mentor`, `ClassCordinator`, `HintQ`, `Answer`) VALUES
('C2K15105154', '12345678', 'Sangat Das', 'TE1', 'N1', 'O138', 'EMP123456789000', '1', 'Sadhu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`EmpID`);

--
-- Indexes for table `StaffApps`
--
ALTER TABLE `StaffApps`
  ADD PRIMARY KEY (`AppID`),
  ADD KEY `fk_id` (`EmpID`);

--
-- Indexes for table `StudApps`
--
ALTER TABLE `StudApps`
  ADD PRIMARY KEY (`AppID`),
  ADD KEY `id` (`ID`),
  ADD KEY `fk_cc_id` (`cc_id`),
  ADD KEY `fk_mentor_id` (`mentor_id`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`EnrollID`),
  ADD KEY `ment` (`Mentor`),
  ADD KEY `cc` (`ClassCordinator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `StaffApps`
--
ALTER TABLE `StaffApps`
  MODIFY `AppID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `StudApps`
--
ALTER TABLE `StudApps`
  MODIFY `AppID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `StaffApps`
--
ALTER TABLE `StaffApps`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`EmpID`) REFERENCES `Staff` (`EmpID`);

--
-- Constraints for table `StudApps`
--
ALTER TABLE `StudApps`
  ADD CONSTRAINT `fk_cc_id` FOREIGN KEY (`cc_id`) REFERENCES `Staff` (`EmpID`),
  ADD CONSTRAINT `fk_mentor_id` FOREIGN KEY (`mentor_id`) REFERENCES `Staff` (`EmpID`),
  ADD CONSTRAINT `id` FOREIGN KEY (`ID`) REFERENCES `Student` (`EnrollID`);

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `cc` FOREIGN KEY (`ClassCordinator`) REFERENCES `Staff` (`EmpID`),
  ADD CONSTRAINT `ment` FOREIGN KEY (`Mentor`) REFERENCES `Staff` (`EmpID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
