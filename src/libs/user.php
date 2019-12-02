<?php
    class User {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon, $user_email) {
            $this->db_connection = $dbCon;

            $query = mysqli_query($this->db_connection, "SELECT * FROM user where emailAddress='$user_email'");
            $this->user = mysqli_fetch_array($query);
        }

        function getUser() {
            return $this->user;
        }

        function getUserID() {
            return $this->user['userID'];
        }

        function getUserEmail() {
            return $this->user['emailAddress'];
        }

        function getUsername() {
            return $this->user['username'];
        }

        function getUserFirstName() {
            return $this->user['firstName'];
        }

        function getUserLastName() {
            return $this->user['lastName'];
        }

        function getUserGender() {
            return $this->user['gender'];
        }

        function getUserDateOfBirth() {
            return $this->user['dob'];
        }

        function createEvent($eventArray) {
            $userID = $this->getUserID();

            // make person event manager
            $insert_EventManagerQuery =  mysqli_query($this->db_connection, "INSERT INTO event_manager (userID, statusCode) VALUES
            ('$userID', 'PENDING')");
            $eventMangerID = mysqli_insert_id($this->db_connection);

            // create event
            $insert_EventManagerQuery =  mysqli_query($this->db_connection, "INSERT INTO event (eventManagerID, eventName, eventDescription, eventPhoneNumber, eventType, size, startDate, endDate, pageTemplate) VALUES
            ('$eventMangerID', '$eventArray[0]', '$eventArray[1]', '$eventArray[2]', '$eventArray[3]', '$eventArray[4]', '$eventArray[5]', '$eventArray[6]', '$eventArray[7]')");
            $eventID = mysqli_insert_id($this->db_connection);

            // populate event list
            $insert_EventList =  mysqli_query($this->db_connection, "INSERT INTO event_list (eventID, userID, statusPosition) VALUES
            ('$eventID', '$userID', 'EVENTMANAGER')");
        }

        function getManagedEventNameAndStatus() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT e.eventID, em.statusCode, e.eventName, e.pageTemplate
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE u.userID='$userID'
                                                         ORDER BY e.eventID DESC");

            $managedEvent_num_rows = mysqli_num_rows($query);
            if($managedEvent_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getManagedEventNameAndStatusLIMIT() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT e.eventID, em.statusCode, e.eventName, e.pageTemplate
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE u.userID='$userID'
                                                         ORDER BY e.eventID DESC
                                                         LIMIT 3");

            $managedEvent_num_rows = mysqli_num_rows($query);
            if($managedEvent_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }


        function getManagedEventsNameAndID() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT e.eventName, e.eventID
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE u.userID='$userID'
                                                         ORDER BY e.eventID DESC");

            $managedEvent_num_rows = mysqli_num_rows($query);
            if($managedEvent_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllPendingRequestToEvents() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT u.userID, e.eventID, u.username, el.statusCode, e.eventName
                                                         FROM user u
                                                         INNER JOIN event_list el ON u.userID = el.userID
                                                         INNER JOIN event e ON el.eventID = e.eventID
                                                         WHERE el.statusCode='PENDING' AND e.eventID IN
                                                            (SELECT e.eventID
                                                            FROM user u
                                                            INNER JOIN event_manager em ON u.userID = em.userID
                                                            INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                            WHERE u.userID='$userID')");

            $eventPendingToJoin_num_rows = mysqli_num_rows($query);
            if($eventPendingToJoin_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function updateRequestedPeopleToJoinEvent($eventID, $userID, $newStatus) {
            $update_RequestedPeopleToJoinEvent =  mysqli_query($this->db_connection, "UPDATE event_list el
                                                                                      INNER JOIN user u ON el.userID = u.userID
                                                                                      SET el.statusCode='APPROVED'
                                                                                      WHERE el.eventID = '$eventID' AND u.userID='$userID' AND el.statusCode='PENDING'");

            if(!$update_RequestedPeopleToJoinEvent) {
                echo 'placeholder could not update';
            } else {
                echo 'updated placeholder';
            }
        }

        function getAllPendingRequestedEvents() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT el.statusCode, e.eventName
                                                         FROM user u
                                                         INNER JOIN event_list el ON u.userID = el.userID
                                                         INNER JOIN event e ON el.eventID = e.eventID
                                                         WHERE u.userID='$userID' AND el.statusCode='PENDING'");

            $eventRequested_num_rows = mysqli_num_rows($query);
            if($eventRequested_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllRequestedEventsLIMIT() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT el.statusCode, e.eventName
                                                         FROM user u
                                                         INNER JOIN event_list el ON u.userID = el.userID
                                                         INNER JOIN event e ON el.eventID = e.eventID
                                                         WHERE u.userID='$userID' AND el.statusCode='PENDING'
                                                         ORDER BY e.eventID DESC
                                                         LIMIT 3");

            $eventRequested_num_rows = mysqli_num_rows($query);
            if($eventRequested_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllGoingEvents() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT e.eventID, e.eventDescription, el.statusCode, e.eventName, e.pageTemplate
                                                         FROM user u
                                                         INNER JOIN event_list el ON u.userID = el.userID
                                                         INNER JOIN event e ON el.eventID = e.eventID
                                                         WHERE u.userID='$userID' AND el.statusCode='APPROVED'");

            $eventGoing_num_rows = mysqli_num_rows($query);
            if($eventGoing_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function joinEvent($eventID) {
            $userID = $this->getUserID();

            $insert_JoinEventQuery =  mysqli_query($this->db_connection, "INSERT INTO event_list (eventID, userID, statusPosition, statusCode) VALUES
                                                                        ('$eventID', '$userID', 'PARTICIPANT', 'PENDING')");
        }

        // Start of functions for groups

        function createGroup($groupArray) {
            $userID = $this->getUserID();
            $eventManagerID = $this->getEventManagerIDFromUserID($userID);
            // create group
            $insert_groupQuery =  mysqli_query($this->db_connection, "INSERT INTO groups (groupManagerID, groupName, groupDescription, eventID) VALUES
            ('$eventManagerID', '$groupArray[0]', '$groupArray[1]', '$groupArray[2]')");
        }

        function joinGroup($groupID) {
            $userID = $this->getUserID();
            // create group
            $update_groupQuery =  mysqli_query($this->db_connection, "INSERT INTO group_member_list (groupID, userID, statusPosition, statusCode) VALUES
            ('$groupID', '$userID', 'MEMBER', 'PENDING')");
        }


        function getEventManagerIDFromUserID($userID) {
            $query = mysqli_query($this->db_connection, "SELECT eventManagerID
                                                         FROM event_manager
                                                         WHERE userID = '$userID'");
            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['eventManagerID'];
            }

        }

        function getManagedGroupName() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT groupName, groupDescription, groupID
                                                         FROM groups
                                                         WHERE groupManagerID='$userID'
                                                         ORDER BY groupID DESC");

            $managedGroups_num_rows = mysqli_num_rows($query);
            if($managedGroups_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllPendingRequestedGroups() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT gml.statusCode, g.groupName
                                                         FROM groups g
                                                         INNER JOIN group_member_list gml ON g.groupID = gml.groupID
                                                         WHERE gml.userID='$userID' AND gml.statusCode='PENDING'");

            $groupRequested_num_rows = mysqli_num_rows($query);
            if($groupRequested_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllRequestedGroupsLIMIT() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT gml.statusCode, g.groupName
                                                         FROM groups g
                                                         INNER JOIN group_member_list gml ON g.groupID = gml.groupID
                                                         WHERE gml.userID='$userID' AND gml.statusCode='PENDING'
                                                         ORDER BY g.groupID DESC
                                                         LIMIT 3");

            $groupRequested_num_rows = mysqli_num_rows($query);
            if($groupRequested_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllPendingRequestedToGroup() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT gml.statusCode, u.userID, u.firstName, u.lastName, gml.groupID, g.groupName
                                                         FROM groups g
                                                         INNER JOIN group_member_list gml ON g.groupID = gml.groupID
                                                         INNER JOIN user u ON gml.userID = u.userID
                                                         WHERE g.groupManagerID='$userID' AND gml.statusCode='PENDING'");

            $toGroupRequested_num_rows = mysqli_num_rows($query);
            if($toGroupRequested_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function updateRequestedPeopleToJoinGroup($groupID, $userID, $newStatus) {
            $update_RequestedPeopleToJoinEvent =  mysqli_query($this->db_connection, "UPDATE group_member_list
                                                                                      SET statusCode='APPROVED'
                                                                                      WHERE groupID = '$groupID' AND userID='$userID' AND statusCode='PENDING'");

            if(!$update_RequestedPeopleToJoinEvent) {
                echo 'placeholder could not update';
            } else {
                echo 'updated placeholder';
            }
        }

        function getAllJoinedGroups() {
            $userID = $this->getUserID();
            $query = mysqli_query($this->db_connection, "SELECT gml.statusCode, g.groupName, g.groupID, g.groupDescription
                                                         FROM group_member_list gml
                                                         INNER JOIN groups g ON gml.groupID = g.groupID
                                                         WHERE gml.userID='$userID' AND gml.statusCode='APPROVED'");

            $joinedGroups_num_rows = mysqli_num_rows($query);
            if($joinedGroups_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllAvailableGroups() {
            $userID = $this->getUserID();
            $query = mysqli_query($this->db_connection, "SELECT DISTINCT g.groupName, g.groupID
                                                         FROM groups g
                                                         INNER JOIN event_list el ON g.eventID = el.eventID
                                                         LEFT JOIN group_member_list gml ON g.groupID = gml.groupID
                                                         WHERE el.userID = '$userID'");

                                                        //  SELECT DISTINCT g.groupName, g.groupID
                                                        //  FROM groups g
                                                        //  INNER JOIN event_list el ON g.eventID = el.eventID
                                                        //  LEFT JOIN group_member_list gml ON g.groupID = gml.groupID
                                                        //  WHERE el.userID = '$userID' AND gml.userID != '$userID'");

                                                        //  SELECT DISTINCT g.groupName, g.groupID
                                                        //  FROM groups g
                                                        //  INNER JOIN event_list el ON g.eventID = el.eventID
                                                        //  LEFT JOIN group_member_list gml ON g.groupID = gml.groupID
                                                        //  WHERE el.userID = 3 AND gml.groupID != (SELECT groupID FROM group_member_list WHERE userID = 3)
            $joinedGroups_num_rows = mysqli_num_rows($query);
            if($joinedGroups_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }



        // function getAllUserAvailableGroups() {
        //     $userID = $this->user->getUserID();
        //     $query = mysqli_query($this->db_connection, "SELECT e.eventID, e.eventName, e.eventDescription, e.eventType, e.startDate, e.endDate
        //                                                  FROM user u
        //                                                  INNER JOIN event_manager em ON u.userID = em.userID
        //                                                  INNER JOIN event e ON em.eventManagerID = e.eventManagerID
        //                                                  WHERE em.statusCode='APPROVED' AND em.userID !='$userID'");

        //     $all_approved_events_num_rows = mysqli_num_rows($query);
        //     if($all_approved_events_num_rows) {
        //         return mysqli_fetch_all($query, MYSQLI_ASSOC);
        //     }
        //     else {
        //         return [];
        //     }
        // }

        function submitEventPosts($eID, $content) {
            $userID = $this->getUserID();
            $username = $this->getUsername();
            $eventID = $eID;
            $created_at = date("Y-m-d H:i:s");

            $no_tags_body_content = strip_tags($content);
            $ignore_special_characters_body_content = mysqli_real_escape_string($this->db_connection, $no_tags_body_content);

            $insert_EventPosts =  mysqli_query($this->db_connection, "INSERT INTO event_posts (eventID, content, timeOfPosting, userWhoPosted) VALUES
                                                                    ('$eventID', '$ignore_special_characters_body_content', '$created_at', '$username')");
        }

        function submitRepliesToEventPosts($pID, $content) {
            $userID = $this->getUserID();
            $username = $this->getUsername();
            $postsID = $pID;
            $created_at = date("Y-m-d H:i:s");

            $no_tags_body_content = strip_tags($content);
            $ignore_special_characters_body_content = mysqli_real_escape_string($this->db_connection, $no_tags_body_content);

            $insert_RepliesToPosts =  mysqli_query($this->db_connection, "INSERT INTO event_posts_replies (postsID, content, timeOfPosting, userWhoPosted) VALUES
                                                                    ('$postsID', '$ignore_special_characters_body_content', '$created_at', '$username')");
        }

        function submitGroupPosts($groupID, $content) {
            $userID = $this->getUserID();
            $username = $this->getUsername();
            $created_at = date("Y-m-d H:i:s");
            $no_tags_body_content = strip_tags($content);
            $ignore_special_characters_body_content = mysqli_real_escape_string($this->db_connection, $no_tags_body_content);
            $insert_groupPosts =  mysqli_query($this->db_connection, "INSERT INTO group_posts (groupID, content, timeOfPosting, userWhoPosted) VALUES
                                                                    ('$groupID', '$ignore_special_characters_body_content', '$created_at', '$username')");
        }

        function submitRepliesToGroupPosts($pID, $content) {
            $userID = $this->getUserID();
            $username = $this->getUsername();
            $postsID = $pID;
            $created_at = date("Y-m-d H:i:s");

            $no_tags_body_content = strip_tags($content);
            $ignore_special_characters_body_content = mysqli_real_escape_string($this->db_connection, $no_tags_body_content);

            $insert_RepliesToPosts =  mysqli_query($this->db_connection, "INSERT INTO group_posts_replies (gPostsID, content, timeOfPosting, userWhoPosted) VALUES
                                                                    ('$postsID', '$ignore_special_characters_body_content', '$created_at', '$username')");
        }

        function getAllCorrespondingUsers($keywords) {
            if(sizeof($keywords) == 1) {
                $words = $keywords[0];
                if(strlen($words) == 0) {
                    $query = mysqli_query($this->db_connection, "SELECT *
                                                                 FROM user");
                } else {
                    $query = mysqli_query($this->db_connection, "SELECT *
                                                                 FROM user
                                                                 WHERE firstName like '%$words%' OR lastName like '%$words%'");
                }
            } else {
                $first = $keywords[0];
                $second = $keywords[1];
                $query = mysqli_query($this->db_connection, "SELECT *
                                                             FROM user
                                                             WHERE (firstName like '%$first%' AND lastName like '%$second%')
                                                             OR (firstName like '%$second%' AND lastName like '%$first%')");
            }
            $users_num_rows = mysqli_num_rows($query);
            if($users_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function deleteUser($userID) {
            $query = mysqli_query($this->db_connection, "DELETE
                                                         FROM user
                                                         WHERE userID = $userID");
        }
    }
?>
