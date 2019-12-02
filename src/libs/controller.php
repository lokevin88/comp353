<?php
    class Controller extends User {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon, $user_email) {
            $this->db_connection = $dbCon;

            $query = mysqli_query($this->db_connection, "SELECT * FROM controller where emailAddress='$user_email'");
            $this->user = mysqli_fetch_array($query);
        }

        function getAllReviewingEvents() {
            $query = mysqli_query($this->db_connection, "SELECT e.eventID, u.username, em.statusCode, e.eventName
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE em.statusCode='REVIEWING'");

            $eventReviewing_num_rows = mysqli_num_rows($query);
            if($eventReviewing_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function updateEventManagerStatus($eventID, $eventFeeID) {

            $update_StatusCodeQuery =  mysqli_query($this->db_connection, "UPDATE event_manager em
                                                                           INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                                           SET em.statusCode='PAYMENT'
                                                                           WHERE e.eventID = '$eventID'");

            $update_eventFeeQuery =  mysqli_query($this->db_connection, "UPDATE event
                                                                         SET eventFeeID='$eventFeeID'
                                                                         WHERE eventID = '$eventID'");
            if(!$update_StatusCodeQuery) {
                echo 'placeholder could not update';
            } else {
                echo 'updated placeholder';
            }
        }

        function getControllerID($email) {
            $query = mysqli_query($this->db_connection, "SELECT controllerID
                                                         FROM controller
                                                         WHERE emailAddress = '$email'");
            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['controllerID'];
            }
            $db_connection.close();

        }
        function createEventFee($controllerID, $chargeRate) {
            $query = mysqli_query($this->db_connection, "INSERT INTO event_fee_calculation (controllerID, chargeRate)
                                                         VALUES ('$controllerID', '$chargeRate')");
            $eventFeeID = mysqli_insert_id($this->db_connection);
            if($eventFeeID) {
                return $eventFeeID;
            }
            else {
                return "";
            }
        }
    }
?>
