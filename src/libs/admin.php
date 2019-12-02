<?php
    class Admin {
        private $db_connection = null;

        function __construct($dbCon) {
            $this->db_connection = $dbCon;
        }

        function getAllPendingEvents() {
            $query = mysqli_query($this->db_connection, "SELECT e.eventID, u.username, em.statusCode, e.eventName
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE em.statusCode='PENDING'");

            $eventPending_num_rows = mysqli_num_rows($query);
            if($eventPending_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllEventsStatus() {
            $query = mysqli_query($this->db_connection, "SELECT e.eventName, em.statusCode
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID");

            $eventStatus_num_rows = mysqli_num_rows($query);
            if($eventStatus_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function updateEventManagerStatus($eventID, $newStatus) {

            $update_StatusCodeQuery =  mysqli_query($this->db_connection, "UPDATE event_manager em
                                                                           INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                                           SET em.statusCode='$newStatus'
                                                                           WHERE e.eventID = '$eventID'");

            if(!$update_StatusCodeQuery) {
                echo 'placeholder could not update';
            } else {
                echo 'updated placeholder';
            }
        }

        function getAdminID($email) {
            $query = mysqli_query($this->db_connection, "SELECT adminID
                                                         FROM admin
                                                         WHERE emailAddress = '$email'");
            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['adminID'];
            }
            $db_connection.close();

        }

        function getEmail($adminID) {
            $query = mysqli_query($this->db_connection, "SELECT emailAddress
                                                         FROM admin
                                                         WHERE adminID = '$adminID'");
            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['emailAddress'];
            }
        }

        function updateEmail($adminID, $email) {
            $query = mysqli_query($this->db_connection, "UPDATE admin
                                                         SET emailAddress = '$email'
                                                         WHERE adminID = '$adminID'");
        }
    }
?>
