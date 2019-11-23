<?php
    class Admin {
        private $db_connection = null;

        function __construct($dbCon) {
            $this->db_connection = $dbCon;
        }

        function getAllPendingEvents() {
            $query = mysqli_query($this->db_connection, "SELECT u.username, em.statusCode, e.eventName
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE em.statusCode='PENDING'");

            $eventPending_rows = mysqli_num_rows($query);
            if($eventPending_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return 'NO EVENTS placeholder';
            }
        }
    }
?>
