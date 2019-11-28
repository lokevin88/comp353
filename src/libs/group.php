<?php
    class Group {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon) {
            $this->db_connection = $dbCon;
        }

        function getGroupName($id) {
            $query = mysqli_query($this->db_connection, "SELECT groupName
                                                         FROM groups
                                                         WHERE groupID = $id");
            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['groupName'];
            }
        }

    }
?>
