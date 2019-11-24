<?php
    class Controller {
        private $db_connection = null;

        function __construct($dbCon) {
            $this->db_connection = $dbCon;
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

        function updateEventManagerStatus($eventID) {

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
    }
?>
