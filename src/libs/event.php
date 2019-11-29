<?php
    class Event {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon, $user_email) {
            $this->db_connection = $dbCon;
            $this->user = new User($this->db_connection, $user_email);
        }

        function getAllApprovedEvents() {
            $userID = $this->user->getUserID();
            $query = mysqli_query($this->db_connection, "SELECT e.eventID, e.eventName, e.eventDescription, e.eventType, e.startDate, e.endDate
                                                         FROM user u
                                                         INNER JOIN event_manager em ON u.userID = em.userID
                                                         INNER JOIN event e ON em.eventManagerID = e.eventManagerID
                                                         WHERE em.statusCode='APPROVED' AND em.userID !='$userID'");

            $all_approved_events_num_rows = mysqli_num_rows($query);
            if($all_approved_events_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllPostsFromEvent($eventID) {
            $query = mysqli_query($this->db_connection, "SELECT content, timeOfPosting, userWhoPosted
                                                         FROM event_posts ep
                                                         WHERE eventID ='$eventID'
                                                         ORDER BY timeOfPosting DESC");

            $all_approved_events_num_rows = mysqli_num_rows($query);
            if($all_approved_events_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

    }
?>
