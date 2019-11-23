
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rr_comp353_2`
--

DROP DATABASE IF EXISTS rr_comp353_2;
CREATE DATABASE rr_comp353_2
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;
USE rr_comp353_2;

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
    adminID int(11) NOT NULL AUTO_INCREMENT,
    emailAddress varchar(255) NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    profilePicture varchar(255) NOT NULL,
    CONSTRAINT PK_Admin PRIMARY KEY (adminID)
);

INSERT INTO admin (emailAddress, username, password, profilePicture) VALUES ('admin@db.com', 'admin', 'admin', '/comp353/src/assets/images/mockadmin.png');

DROP TABLE IF EXISTS controller;
CREATE TABLE controller (
    controllerID int(11) NOT NULL AUTO_INCREMENT,
    emailAddress varchar(255) NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    profilePicture varchar(255) NOT NULL,
    CONSTRAINT PK_Controller PRIMARY KEY (controllerID)
);

INSERT INTO controller (emailAddress, username, password, profilePicture) VALUES ('controller@db.com', 'controller', 'controller', '/comp353/src/assets/images/mockcontroller.png');

DROP TABLE IF EXISTS user;
CREATE TABLE user (
    userID int(11) NOT NULL AUTO_INCREMENT,
    emailAddress varchar(255) NOT NULL,
    username varchar(50) NOT NULL,
    firstName varchar(50) NOT NULL,
    lastName varchar(50) NOT NULL,
    gender varchar(15) NOT NULL,
    dob DATE NOT NULL,
    profilePicture varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    CONSTRAINT PK_User PRIMARY KEY (userID)
);

DROP TABLE IF EXISTS event_manager;
CREATE TABLE event_manager (
    eventManagerID int(11) NOT NULL AUTO_INCREMENT,
    userID int(11) NOT NULL,
    statusCode varchar(15) NOT NULL,
    CONSTRAINT PK_Event_Manager PRIMARY KEY (eventManagerID),
    CONSTRAINT FK_Event_Manager_User FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS event;
CREATE TABLE event (
    eventID int(11) NOT NULL AUTO_INCREMENT,
    eventManagerID int(11) NOT NULL,
    eventName varchar(255) NOT NULL,
    eventDescription text NOT NULL,
    eventPhoneNumber varchar(50) NOT NULL,
    eventType varchar(50) NOT NULL,
    size int(11) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    pageTemplate varchar(255) NOT NULL,
    CONSTRAINT PK_Event PRIMARY KEY (eventID),
    CONSTRAINT FK_Event_Manager FOREIGN KEY (eventManagerID) REFERENCES event_manager(eventManagerID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS event_list;
CREATE TABLE event_list (
    eventID int(11) NOT NULL,
    userID int(11) NOT NULL,
    CONSTRAINT PK_Event_List PRIMARY KEY (eventID, userID),
    CONSTRAINT FK_Event_List_Event FOREIGN KEY (eventID) REFERENCES event(eventID) ON DELETE CASCADE,
    CONSTRAINT FK_Event_List_User FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE
);
