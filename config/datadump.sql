-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2019 at 04:38 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rrc353_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `emailAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profilePicture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `emailAddress`, `username`, `password`, `profilePicture`) VALUES
(1, 'admin@db.com', 'admin', 'admin', 'https://rrc353.encs.concordia.ca/comp353/src/assets/images/mockadmin.png');

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE `controller` (
  `controllerID` int(11) NOT NULL,
  `emailAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profilePicture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`controllerID`, `emailAddress`, `username`, `password`, `profilePicture`) VALUES
(1, 'controller@db.com', 'controller', 'controller', 'https://rrc353.encs.concordia.ca/comp353/src/assets/images/mockcontroller.png');

-- --------------------------------------------------------

--
-- Table structure for table `debit_details`
--

CREATE TABLE `debit_details` (
  `debitDetailsID` int(11) NOT NULL,
  `eventManagerID` int(11) NOT NULL,
  `cardNumber` int(11) NOT NULL,
  `cardHolderName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `securityCode` int(11) NOT NULL,
  `billingAddress` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(11) NOT NULL,
  `eventManagerID` int(11) NOT NULL,
  `eventFeeID` int(11) DEFAULT NULL,
  `eventName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventDescription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventPhoneNumber` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventType` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `pageTemplate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `eventManagerID`, `eventFeeID`, `eventName`, `eventDescription`, `eventPhoneNumber`, `eventType`, `size`, `startDate`, `endDate`, `pageTemplate`) VALUES
(1, 1, 1, 'Some Event', 'Some amazing event', '888-888-8888', 'public', 25, '2019-12-24', '2019-12-26', 'https://rrc353.encs.concordia.ca/comp353/src/pages/eventTemplate/event-template1.php'),
(2, 1, 1, 'Some Christmas Event', 'Some amazing christmas event', '888-888-8888', 'public', 25, '2019-12-24', '2019-12-26', 'https://rrc353.encs.concordia.ca/comp353/src/pages/eventTemplate/event-template2.php');

-- --------------------------------------------------------

--
-- Table structure for table `event_fee_calculation`
--

CREATE TABLE `event_fee_calculation` (
  `eventFeeID` int(11) NOT NULL,
  `controllerID` int(11) NOT NULL,
  `chargeRate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_fee_calculation`
--

INSERT INTO `event_fee_calculation` (`eventFeeID`, `controllerID`, `chargeRate`) VALUES
(1, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

CREATE TABLE `event_list` (
  `eventID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `statusPosition` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusCode` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`eventID`, `userID`, `statusPosition`, `statusCode`) VALUES
(1, 1, 'EVENTMANAGER', ''),
(1, 2, 'PARTICIPANT', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `event_manager`
--

CREATE TABLE `event_manager` (
  `eventManagerID` int(11) NOT NULL,
  `debitDetailsID` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `statusCode` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_manager`
--

INSERT INTO `event_manager` (`eventManagerID`, `debitDetailsID`, `userID`, `statusCode`) VALUES
(1, NULL, 1, 'APPROVED'),
(2, NULL, 3, 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `event_posts`
--

CREATE TABLE `event_posts` (
  `postsID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeOfPosting` datetime NOT NULL,
  `userWhoPosted` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_posts_replies`
--

CREATE TABLE `event_posts_replies` (
  `repliesID` int(11) NOT NULL,
  `postsID` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeOfPosting` datetime NOT NULL,
  `userWhoPosted` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupID` int(11) NOT NULL,
  `groupManagerID` int(11) NOT NULL,
  `groupName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groupDescription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupID`, `groupManagerID`, `groupName`, `groupDescription`, `eventID`) VALUES
(1, 1, 'Group1', 'The first group', 1),
(2, 1, 'Group2', 'The second group', 2);

-- --------------------------------------------------------

--
-- Table structure for table `group_member_list`
--

CREATE TABLE `group_member_list` (
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `statusPosition` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusCode` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_member_list`
--

INSERT INTO `group_member_list` (`groupID`, `userID`, `statusPosition`, `statusCode`) VALUES
(1, 2, 'PARTICIPANT', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `group_posts`
--

CREATE TABLE `group_posts` (
  `gPostsID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeOfPosting` datetime NOT NULL,
  `userWhoPosted` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_posts_replies`
--

CREATE TABLE `group_posts_replies` (
  `repliesID` int(11) NOT NULL,
  `gPostsID` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeOfPosting` datetime NOT NULL,
  `userWhoPosted` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `emailAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `profilePicture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `emailAddress`, `username`, `firstName`, `lastName`, `gender`, `dob`, `profilePicture`, `password`) VALUES
(1, 'user@db.com', 'user', 'firstUser', 'lastUser', 'male', '1999-10-11', 'https://rrc353.encs.concordia.ca/comp353/src/assets/images/mockuser.png', 'user'),
(2, 'user2@db.com', 'user2', 'firstUser2', 'lastUser2', 'male', '1999-10-11', 'https://rrc353.encs.concordia.ca/comp353/src/assets/images/mockuser.png', 'user'),
(3, 'user3@db.com', 'user3', 'firstUser3', 'lastUser3', 'male', '1999-10-11', 'https://rrc353.encs.concordia.ca/comp353/src/assets/images/mockuser.png', 'user'),
(4, 'mary@db.com', 'mary', 'Mary', 'Doe', 'Female', '1989-10-12', 'https://rrc353.encs.concordia.ca/comp353/src/assets/images/mockuser.png', 'mary'),
(5, 'john@db.com', 'john', 'John', 'Doe', 'Male', '1979-12-11', 'https://rrc353.encs.concordia.ca/comp353/src/assets/images/mockuser.png', 'john');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `controller`
--
ALTER TABLE `controller`
  ADD PRIMARY KEY (`controllerID`);

--
-- Indexes for table `debit_details`
--
ALTER TABLE `debit_details`
  ADD PRIMARY KEY (`debitDetailsID`),
  ADD KEY `FK_Event_Manager_ID` (`eventManagerID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `FK_Event_Manager` (`eventManagerID`),
  ADD KEY `FK_Event_Event_FEE` (`eventFeeID`);

--
-- Indexes for table `event_fee_calculation`
--
ALTER TABLE `event_fee_calculation`
  ADD PRIMARY KEY (`eventFeeID`),
  ADD KEY `FK_Event_Fee_Controller` (`controllerID`);

--
-- Indexes for table `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`eventID`,`userID`),
  ADD KEY `FK_Event_List_User` (`userID`);

--
-- Indexes for table `event_manager`
--
ALTER TABLE `event_manager`
  ADD PRIMARY KEY (`eventManagerID`),
  ADD KEY `FK_Event_Manager_User` (`userID`);

--
-- Indexes for table `event_posts`
--
ALTER TABLE `event_posts`
  ADD PRIMARY KEY (`postsID`),
  ADD KEY `FK_Event_Posts_Event_ID` (`eventID`);

--
-- Indexes for table `event_posts_replies`
--
ALTER TABLE `event_posts_replies`
  ADD PRIMARY KEY (`repliesID`),
  ADD KEY `FK_Event_Posts_Replies_Posts_ID` (`postsID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `FK_Group_Event_ID` (`eventID`),
  ADD KEY `FK_Group_Manager` (`groupManagerID`);

--
-- Indexes for table `group_member_list`
--
ALTER TABLE `group_member_list`
  ADD PRIMARY KEY (`groupID`,`userID`),
  ADD KEY `FK_Group_Member_List_User` (`userID`);

--
-- Indexes for table `group_posts`
--
ALTER TABLE `group_posts`
  ADD PRIMARY KEY (`gPostsID`),
  ADD KEY `FK_Group_Posts_Group_ID` (`groupID`);

--
-- Indexes for table `group_posts_replies`
--
ALTER TABLE `group_posts_replies`
  ADD PRIMARY KEY (`repliesID`),
  ADD KEY `FK_Group_Posts_Replies_Posts_ID` (`gPostsID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `controller`
--
ALTER TABLE `controller`
  MODIFY `controllerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `debit_details`
--
ALTER TABLE `debit_details`
  MODIFY `debitDetailsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_fee_calculation`
--
ALTER TABLE `event_fee_calculation`
  MODIFY `eventFeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_manager`
--
ALTER TABLE `event_manager`
  MODIFY `eventManagerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_posts`
--
ALTER TABLE `event_posts`
  MODIFY `postsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_posts_replies`
--
ALTER TABLE `event_posts_replies`
  MODIFY `repliesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_posts`
--
ALTER TABLE `group_posts`
  MODIFY `gPostsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_posts_replies`
--
ALTER TABLE `group_posts_replies`
  MODIFY `repliesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debit_details`
--
ALTER TABLE `debit_details`
  ADD CONSTRAINT `FK_Event_Manager_ID` FOREIGN KEY (`eventManagerID`) REFERENCES `event_manager` (`eventManagerID`) ON DELETE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_Event_Event_FEE` FOREIGN KEY (`eventFeeID`) REFERENCES `event_fee_calculation` (`eventFeeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Event_Manager` FOREIGN KEY (`eventManagerID`) REFERENCES `event_manager` (`eventManagerID`) ON DELETE CASCADE;

--
-- Constraints for table `event_fee_calculation`
--
ALTER TABLE `event_fee_calculation`
  ADD CONSTRAINT `FK_Event_Fee_Controller` FOREIGN KEY (`controllerID`) REFERENCES `controller` (`controllerID`) ON DELETE CASCADE;

--
-- Constraints for table `event_list`
--
ALTER TABLE `event_list`
  ADD CONSTRAINT `FK_Event_List_Event` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Event_List_User` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `event_manager`
--
ALTER TABLE `event_manager`
  ADD CONSTRAINT `FK_Event_Manager_User` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `event_posts`
--
ALTER TABLE `event_posts`
  ADD CONSTRAINT `FK_Event_Posts_Event_ID` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE;

--
-- Constraints for table `event_posts_replies`
--
ALTER TABLE `event_posts_replies`
  ADD CONSTRAINT `FK_Event_Posts_Replies_Posts_ID` FOREIGN KEY (`postsID`) REFERENCES `event_posts` (`postsID`) ON DELETE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `FK_Group_Event_ID` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Group_Manager` FOREIGN KEY (`groupManagerID`) REFERENCES `event_manager` (`eventManagerID`) ON DELETE CASCADE;

--
-- Constraints for table `group_member_list`
--
ALTER TABLE `group_member_list`
  ADD CONSTRAINT `FK_Group_Member_List_Group` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Group_Member_List_User` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `group_posts`
--
ALTER TABLE `group_posts`
  ADD CONSTRAINT `FK_Group_Posts_Group_ID` FOREIGN KEY (`groupID`) REFERENCES `groups` (`groupID`) ON DELETE CASCADE;

--
-- Constraints for table `group_posts_replies`
--
ALTER TABLE `group_posts_replies`
  ADD CONSTRAINT `FK_Group_Posts_Replies_Posts_ID` FOREIGN KEY (`gPostsID`) REFERENCES `group_posts` (`gPostsID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
