DROP DATABASE IF EXISTS rrc353_2;
CREATE DATABASE rrc353_2
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;
USE rrc353_2;

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
    debitDetailsID int(11),
    userID int(11) NOT NULL,
    statusCode varchar(15) NOT NULL,
    CONSTRAINT PK_Event_Manager PRIMARY KEY (eventManagerID),
    CONSTRAINT FK_Event_Manager_User FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS debit_details;
CREATE TABLE debit_details (
    debitDetailsID int(11) NOT NULL AUTO_INCREMENT,
    eventManagerID int(11) NOT NULL,
    cardNumber int(11) NOT NULL,
    cardHolderName varchar(50) NOT NULL,
    securityCode int(11) NOT NULL,
    billingAddress varchar(200) NOT NULL,
    CONSTRAINT PK_Debit_Details PRIMARY KEY (debitDetailsID),
    CONSTRAINT FK_Event_Manager_ID FOREIGN KEY (eventManagerID) REFERENCES event_manager(eventManagerID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS event_fee_calculation;
CREATE TABLE event_fee_calculation (
    eventFeeID int(11) NOT NULL AUTO_INCREMENT,
    controllerID int(11) NOT NULL,
    chargeRate int(11) NOT NULL,
    CONSTRAINT PK_Event_Fee PRIMARY KEY (eventFeeID),
    CONSTRAINT FK_Event_Fee_Controller FOREIGN KEY (controllerID) REFERENCES controller(controllerID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS event;
CREATE TABLE event (
    eventID int(11) NOT NULL AUTO_INCREMENT,
    eventManagerID int(11) NOT NULL,
    eventFeeID int(11),
    eventName varchar(255) NOT NULL,
    eventDescription text NOT NULL,
    eventPhoneNumber varchar(50) NOT NULL,
    eventType varchar(50) NOT NULL,
    size int(11) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    pageTemplate varchar(255) NOT NULL,
    CONSTRAINT PK_Event PRIMARY KEY (eventID),
    CONSTRAINT FK_Event_Manager FOREIGN KEY (eventManagerID) REFERENCES event_manager(eventManagerID) ON DELETE CASCADE,
    CONSTRAINT FK_Event_Event_FEE FOREIGN KEY (eventFeeID) REFERENCES event_fee_calculation(eventFeeID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS event_list;
CREATE TABLE event_list (
    eventID int(11) NOT NULL,
    userID int(11) NOT NULL,
    statusPosition varchar(50) NOT NULL,
    statusCode varchar(15) DEFAULT '',
    CONSTRAINT PK_Event_List PRIMARY KEY (eventID, userID),
    CONSTRAINT FK_Event_List_Event FOREIGN KEY (eventID) REFERENCES event(eventID) ON DELETE CASCADE,
    CONSTRAINT FK_Event_List_User FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS groups;
CREATE TABLE groups (
    groupID int(11) NOT NULL AUTO_INCREMENT,
    eventID int(11) NOT NULL,
    groupManagerID int(11) NOT NULL,
    groupName varchar(255),
    groupDescription varchar(255),
    CONSTRAINT PK_Group PRIMARY KEY (groupID),
    CONSTRAINT FK_Group_Event_ID FOREIGN KEY (eventID) REFERENCES event(eventID) ON DELETE CASCADE,
    CONSTRAINT FK_Group_Manager FOREIGN KEY (groupManagerID) REFERENCES event_manager(eventManagerID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS group_member_list;
CREATE TABLE group_member_list (
    groupID int(11) NOT NULL,
    userID int(11) NOT NULL,
    statusPosition varchar(50) NOT NULL,
    statusCode varchar(15) DEFAULT '',
    CONSTRAINT PK_Group_Member_List PRIMARY KEY (groupID, userID),
    CONSTRAINT FK_Group_Member_List_Group FOREIGN KEY (groupID) REFERENCES groups(groupID) ON DELETE CASCADE,
    CONSTRAINT FK_Group_Member_List_User FOREIGN KEY (userID) REFERENCES user(userID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS event_posts;
CREATE TABLE event_posts (
    postsID int(11) NOT NULL AUTO_INCREMENT,
    eventID int(11) NOT NULL,
    content TEXT NOT NULL,
    timeOfPosting DATETIME NOT NULL,
    userWhoPosted varchar(50) NOT NULL,
    CONSTRAINT PK_Event_Posts PRIMARY KEY (postsID),
    CONSTRAINT FK_Event_Posts_Event_ID FOREIGN KEY (eventID) REFERENCES event(eventID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS event_posts_replies;
CREATE TABLE event_posts_replies (
    repliesID int(11) NOT NULL AUTO_INCREMENT,
    postsID int(11) NOT NULL,
    content TEXT NOT NULL,
    timeOfPosting DATETIME NOT NULL,
    userWhoPosted varchar(50) NOT NULL,
    CONSTRAINT PK_Event_Posts_Replies PRIMARY KEY (repliesID),
    CONSTRAINT FK_Event_Posts_Replies_Posts_ID FOREIGN KEY (postsID) REFERENCES event_posts(postsID) ON DELETE CASCADE
);



DROP TABLE IF EXISTS group_posts;
CREATE TABLE group_posts (
    gPostsID int(11) NOT NULL AUTO_INCREMENT,
    groupID int(11) NOT NULL,
    content TEXT NOT NULL,
    timeOfPosting DATETIME NOT NULL,
    userWhoPosted varchar(50) NOT NULL,
    CONSTRAINT PK_Group_Posts PRIMARY KEY (gPostsID),
    CONSTRAINT FK_Group_Posts_Group_ID FOREIGN KEY (groupID) REFERENCES groups(groupID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS group_posts_replies;
CREATE TABLE group_posts_replies (
    repliesID int(11) NOT NULL AUTO_INCREMENT,
    gPostsID int(11) NOT NULL,
    content TEXT NOT NULL,
    timeOfPosting DATETIME NOT NULL,
    userWhoPosted varchar(50) NOT NULL,
    CONSTRAINT PK_Group_Posts_Replies PRIMARY KEY (repliesID),
    CONSTRAINT FK_Group_Posts_Replies_Posts_ID FOREIGN KEY (gPostsID) REFERENCES group_posts(gPostsID) ON DELETE CASCADE
);

INSERT INTO user
    (userID, emailAddress, username, firstName, lastName, gender, dob, profilePicture, password)
    VALUES (1,"user@db.com","user","firstUser","lastUser","male","1999-10-11","/comp353/src/assets/images/mockuser.png","user");

INSERT INTO user
    (userID, emailAddress, username, firstName, lastName, gender, dob, profilePicture, password)
    VALUES (2,"user2@db.com","user2","firstUser2","lastUser2","male","1999-10-11","/comp353/src/assets/images/mockuser.png","user");

INSERT INTO user
    (userID, emailAddress, username, firstName, lastName, gender, dob, profilePicture, password)
    VALUES (3,"user3@db.com","user3","firstUser3","lastUser3","male","1999-10-11","/comp353/src/assets/images/mockuser.png","user");

INSERT INTO event_fee_calculation(eventFeeID, controllerID, chargeRate) VALUES (1,1, 25);

INSERT INTO event_manager(eventManagerID, userID, statusCode) VALUES (1,1,"APPROVED");

INSERT INTO event_manager(eventManagerID, userID, statusCode) VALUES (2,3,"APPROVED");

INSERT INTO event
    (eventID, eventManagerID, eventFeeID, eventName, eventDescription, eventPhoneNumber, eventType, size, startDate, endDate, pageTemplate)
    VALUES (1,1,1,"Some Event","Some amazing event","888-888-8888","public",25,"2019-12-24","2019-12-26","/comp353/src/pages/eventTemplate/event-template1.php");

INSERT INTO event
    (eventID, eventManagerID, eventFeeID, eventName, eventDescription, eventPhoneNumber, eventType, size, startDate, endDate, pageTemplate)
    VALUES (2,1,1,"Some Christmas Event","Some amazing christmas event","888-888-8888","public",25,"2019-12-24","2019-12-26","/comp353/src/pages/eventTemplate/event-template2.php");

INSERT INTO event_list(eventID, userID, statusPosition, statusCode) VALUES (1,1,"EVENTMANAGER", "");

INSERT INTO event_list(eventID, userID, statusPosition, statusCode) VALUES (1,2,"PARTICIPANT","APPROVED");

INSERT INTO groups(groupID, eventID, groupManagerID, groupName, groupDescription) VALUES (1,1,1,"Group1","The first group");

INSERT INTO groups(groupID, eventID, groupManagerID, groupName, groupDescription) VALUES (2,2,1,"Group2","The second group");

INSERT INTO group_member_list(groupID, userID, statusPosition, statusCode) VALUES (1,2,"PARTICIPANT","PENDING");

INSERT INTO user (emailAddress, username, firstName, lastName, gender, dob, profilePicture, password) VALUES
                 ('mary@db.com', 'mary', 'Mary', 'Doe', 'Female', "1989-10-12", '/comp353/src/assets/images/mockuser.png', 'mary');
INSERT INTO user (emailAddress, username, firstName, lastName, gender, dob, profilePicture, password) VALUES
                 ('john@db.com', 'john', 'John', 'Doe', 'Male', "1979-12-11", '/comp353/src/assets/images/mockuser.png', 'john');
