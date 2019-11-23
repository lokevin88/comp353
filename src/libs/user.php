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
    }
?>
