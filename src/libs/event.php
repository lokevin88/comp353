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

            $insert_EventManagerQuery =  mysqli_query($this->db_connection, "INSERT INTO event (userID, statusCode) VALUES
            ('$userID', 'PENDING')");
        }
        
    }
?>
