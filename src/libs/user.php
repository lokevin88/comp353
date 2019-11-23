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

        function getAllEventNameAndStatus() {
            $userID = $this->getUserID();

            $query = mysqli_query($this->db_connection, "SELECT u.username, em.statusCode, e.eventName
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE u.userID='$userID'
                                                         ORDER BY e.eventID DESC
                                                         LIMIT 6");

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
