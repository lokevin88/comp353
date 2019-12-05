<?php
    require './comp353/src/shared/navbar.php';

    include './comp353/src/libs/group.php';
    include './comp353/src/libs/user.php';

    $group = new Group($databaseConnection);
    $user = new User($databaseConnection, $user_email);

    // For the title
    $groupID = $_GET['groupID'];
    $groupName = $group->getGroupName($groupID);
    $title ="<h1 class='display-4'> Welcome to $groupName Group</h1>";

    // For getting the list of members from that specific group
    $listMembers = $group->getListMembers($groupID);
    $countListMembers = count($listMembers);
    $subtitle = "List of members from " . $groupName . " group:";

    // For checking if the current user is the manager of the group
    $groupManagerID = $group->checkIfUserIsManager($groupID);
    $userID = $user->getUserID();
    $isGroupManager = false;
    if ($groupManagerID == $userID) {
        $isGroupManager = true;
    }

    // For getting all the posts of that specific group
    $group_all_member_posting = $group->getAllPostsFromGroup($groupID);
    $count_all_member_posting = count($group_all_member_posting);

    //All the POST requests for deleting member/group and submit posts
    if(isset($_POST['deleteMember'])) {
        $memberUserID = $_POST['deleteMember'];
        $group->deleteMember($memberUserID);
        navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/group-page.php");
    }

    if(isset($_POST['deleteGroup'])) {
        $currentGroupID = $_POST['deleteGroup'];
        $group->deleteGroup($currentGroupID);
        navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/group-page.php");
    }

    if(isset($_POST['submitGroupPost'])) {
        $body_content = $_POST['message_content'];

        $user->submitGroupPosts($groupID, $body_content);
        navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/group-details-page.php?groupID=$groupID");
    }

?>

<div id="event-template-wrapper" class="main-body">

  <?php
    include './comp353/src/components/bannerAndGroupMessage-component.php';
  ?>

  <div class="row-nomargin">
    <div class="col-lg-9"> <!-- change grid size accordingly from the 12 grid -->
        <?php
            include './comp353/src/components/group-newsfeed-component.php';
        ?>
    </div>
    <div class="col-lg-3"> <!-- change grid size accordingly from the 12 grid -->
      <!-- right side bar -->
        <?php
            include './comp353/src/components/groupSidebar-component.php';
        ?>
    </div>
  </div>
</div>

<?php

    //  always import from above here
    require './comp353/src/shared/jsScript.php';
  ?>
