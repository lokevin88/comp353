<?php
    class Event {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon, $user_email) {
            $this->db_connection = $dbCon;
            $this->user = new User($this->db_connection, $user_email);
        }

        function getEventName($eventID) {
            $query = mysqli_query($this->db_connection, "SELECT eventName
                                                         FROM event e
                                                         WHERE eventID ='$eventID'");

            $eventName = mysqli_fetch_array($query);

            return $eventName['eventName'];
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
            $query = mysqli_query($this->db_connection, "SELECT postsID, content, timeOfPosting, userWhoPosted
                                                         FROM event_posts ep
                                                         WHERE eventID ='$eventID'
                                                         ORDER BY timeOfPosting DESC");

            $all_eventposting_num_rows = mysqli_num_rows($query);
            if($all_eventposting_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }


        function getAllRepliesFromPostsInEvent($eventID, $postsID) {
            $query = mysqli_query($this->db_connection, "SELECT epr.content, epr.timeOfPosting, epr.userWhoPosted
                                                         FROM event_posts_replies epr
                                                         INNER JOIN event_posts ep ON epr.postsID = ep.postsID
                                                         WHERE ep.eventID ='$eventID' AND epr.postsID='$postsID'
                                                         ORDER BY timeOfPosting DESC");

            $all_repliesposting_num_rows = mysqli_num_rows($query);
            if($all_repliesposting_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getEventFee($eventFeeID) {
            $query = mysqli_query($this->db_connection, "SELECT efc.chargeRate
                                                         FROM event_fee_calculation efc
                                                         INNER JOIN event e ON efc.eventFeeID = e.eventFeeID
                                                         WHERE efc.eventFeeID ='$eventFeeID'");

            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['chargeRate'];
            }
        }

    }
?>
