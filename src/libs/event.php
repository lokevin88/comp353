<?php
    class Event {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon, $user_email) {
            $this->db_connection = $dbCon;
            $this->user = new User($this->db_connection, $user_email);
        }

        function createEvent($eventArray) {
            print_r($eventArray);
            $userID = $this->user->getUserID();
            echo $userID;

            // make person event manager
            $insert_EventManagerQuery =  mysqli_query($this->db_connection, "INSERT INTO event_manager (userID, statusCode) VALUES
            ('$userID', 'PENDING')");
            $eventMangerID = mysqli_insert_id($this->db_connection);

            // create event
            $insert_EventManagerQuery =  mysqli_query($this->db_connection, "INSERT INTO event (eventManagerID, eventName, eventDescription, eventPhoneNumber, eventType, size, startDate, endDate, pageTemplate) VALUES
            ('$eventMangerID', '$eventArray[0]', '$eventArray[1]', '$eventArray[2]', '$eventArray[3]', '$eventArray[4]', '$eventArray[5]', '$eventArray[6]', '$eventArray[7]')");
        }

    }
?>
