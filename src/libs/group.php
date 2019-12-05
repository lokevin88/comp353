<?php
    class Group {
        private $user = null;
        private $db_connection = null;

        function __construct($dbCon) {
            $this->db_connection = $dbCon;
        }

        function getGroupName($groupID) {
            $query = mysqli_query($this->db_connection, "SELECT groupName
                                                         FROM `groups`
                                                         WHERE groupID = $groupID");
            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['groupName'];
            }
        }

        function getListMembers($groupID) {
            $query = mysqli_query($this->db_connection, "SELECT gml.userID, u.firstName, u.lastName, gml.statusCode
                                                         FROM group_member_list gml
                                                         INNER JOIN user u ON gml.userID = u.userID
                                                         WHERE gml.groupID = $groupID AND gml.statusCode = 'APPROVED'");
            if($query) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
        }

        function checkIfUserIsManager($groupID) {
            $query = mysqli_query($this->db_connection, "SELECT em.userID
                                                         FROM `groups` g
                                                         INNER JOIN event_manager em ON g.groupManagerID = em.eventManagerID
                                                         WHERE g.groupID = $groupID");
            if($query) {
                $dataAsArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
                return $dataAsArray['userID'];
            }
        }

        function deleteMember($userID) {
            $query = mysqli_query($this->db_connection, "DELETE
                                                         FROM group_member_list
                                                         WHERE userID = $userID");
        }

        function deleteGroup($groupID) {
            $queryGroup = mysqli_query($this->db_connection, "DELETE
                                                              FROM `groups`
                                                              WHERE groupID = $groupID");
            $queryMembers = mysqli_query($this->db_connection, "DELETE
                                                                FROM group_member_list
                                                                WHERE groupID = $groupID");
        }

        function getAllPostsFromGroup($groupID) {
            $query = mysqli_query($this->db_connection, "SELECT content, timeOfPosting, userWhoPosted, gPostsID
                                                         FROM group_posts
                                                         WHERE groupID ='$groupID'
                                                         ORDER BY timeOfPosting DESC");

            $all_group_posts = mysqli_num_rows($query);
            if($all_group_posts) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

        function getAllRepliesFromPostsInGroup($groupID, $postsID) {
            $query = mysqli_query($this->db_connection, "SELECT gpr.content, gpr.timeOfPosting, gpr.userWhoPosted
                                                         FROM group_posts_replies gpr
                                                         INNER JOIN group_posts gp ON gpr.gPostsID = gp.gPostsID
                                                         WHERE gp.groupID ='$groupID' AND gpr.gPostsID='$postsID'
                                                         ORDER BY timeOfPosting DESC");

            $all_repliesposting_num_rows = mysqli_num_rows($query);
            if($all_repliesposting_num_rows) {
                return mysqli_fetch_all($query, MYSQLI_ASSOC);
            }
            else {
                return [];
            }
        }

    }
?>
