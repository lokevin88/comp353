<?php
    class User {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon, $user_email) {
            $this->db_connection = $dbCon;

            $query = mysqli_query($this->db_connection, "SELECT * FROM user where emailAddress='$user_email'");
            $this->user = mysqli_fetch_array($query);
        }

        function getUserID() {
            return $this->user['userID'];
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

            $query = mysqli_query($this->db_connection, "SELECT em.statusCode, e.eventName
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

        function getAllPendingRequestToEvents() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT e.eventID, u.username, el.statusCode, e.eventName
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

        function updateRequestedPeopleToJoinEvent($eventID, $newStatus) {
            $update_RequestedPeopleToJoinEvent =  mysqli_query($this->db_connection, "UPDATE event_list el
                                                                                      INNER JOIN user u ON el.userID = el.userID
                                                                                      SET em.statusCode='APPROVED'
                                                                                      WHERE e.eventID = '$eventID'");

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

        function joinEvent($eventID) {
            $userID = $this->getUserID();

            $insert_JoinEventQuery =  mysqli_query($this->db_connection, "INSERT INTO event_list (eventID, userID, statusPosition, statusCode) VALUES
                                                                        ('$eventID', '$userID', 'PARTICIPANT', 'PENDING')");
        }
    }
?>
