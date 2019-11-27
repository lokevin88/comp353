<!-- TO CHANGE to groups, this only to based off events page -->

<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/event.php';

    $user = new User($databaseConnection, $user_email);
    // get all managed groups
    $user_managed_groups = $user->getManagedGroupName();
    $count_managed_groups_result = count($user_managed_groups);
    // get all requests to join events
    $user_requested_groups_status = $user->getAllPendingRequestedGroups();
    $count_requested_groups_status = count($user_requested_groups_status);
    // get all requestee who wants to join your event
    $user_request_to_join_groups_status = $user->getAllPendingRequestedToGroup();
    $count_request_to_join_groups_status = count($user_request_to_join_groups_status);
    // get all going and approved events
    $user_joined_groups_status = $user->getAllJoinedGroups();
    $count_joined_groups_status = count($user_joined_groups_status);

    //Ongoing groups
    // $event_all_approved = $user->getAllUserAvailableGroups();
    // $count_all_approved_events_status = count($event_all_approved);

    if(isset($_POST['createGroup'])) {
        $groupName = $_POST['groupName'];
        $groupDescription = $_POST['groupDescription'];
        $eventID = $_POST['eventID'];

        $groupArray = array($groupName, $groupDescription, $eventID);

        $user->createGroup($groupArray);
        navigateTo("/comp353/src/pages/group-page.php");
      }

    if(isset($_POST['addToPending'])) {
        $eventID = $_POST['addToPending'];

        $user->joinEvent($eventID);
        navigateTo("/comp353/src/pages/group-page.php");
    }

    if(isset($_POST['addToApproved'])) {
        $groupID = $_POST['addToApproved'];
        $userID = $_POST['userToAccept'];

        $user->updateRequestedPeopleToJoinGroup($groupID, $userID, 'APPROVED');
        navigateTo("/comp353/src/pages/group-page.php");
    }

    if(isset($_POST['addToRejected'])) {
        $eventID = $_POST['addToRejected'];
        $userID = $_POST['userToAccept'];

        $user->updateRequestedPeopleToJoinGroup($groupID, $userID, 'REJECTED');
        navigateTo("/comp353/src/pages/group-page.php");
    }
  ?>

<div id="event-wrapper" class="main-body">

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/bannerAndGroup-component.php';
  ?>

    <div class="row-nomargin">
        <div class="col-lg-12">
            <a name="eventPendingTableName">List of people who wants to join your group</a>
            <div class="table-responsive pendingTable">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Group Name</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="group-page.php" method="post">
                            <?php if($count_request_to_join_groups_status == 0) : ?>
                            <tr class="table-secondary text-center">
                                <td colspan="6">
                                    <h3>No one wants to join your group as of yet</h3>
                                </td>
                            </tr>
                            <?php endif; ?>

                            <?php
                                foreach($user_request_to_join_groups_status as $row):
                            ?>

                            <tr class="table-secondary">
                                <td><?php echo $row['firstName']; ?></td>
                                <td><?php echo $row['lastName']; ?></td>
                                <td><?php echo $row['groupName']; ?></td>
                                <td><?php echo $row['statusCode']; ?></td>
                                <td>
                                    <button type="submit" name="addToApproved" class="btn btn-primary"
                                        value="<?php echo $row['groupID']; ?>">
                                        <i class="fa fa-check"></i> Accept
                                    </button>
                                </td>
                                <td>
                                    <button type="submit" name="addToRejected" class="btn btn-danger"
                                        value="<?php echo $row['groupID']; ?>">
                                        <i class="fa fa-minus-circle"></i> Reject
                                    </button>
                                </td>
                                <td>
                                    <input type="hidden" name="userToAccept" value="<?php echo $row['userID']; ?>" />
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row-nomargin">
        <div class="col-lg-4 whiteBorderAndBlackLines">
            <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/managedGroupStatus.php';
            ?>
        </div>
        <div class="col-lg-4 whiteBorderAndBlackLines">
            <h4>Pending to join</h4>
            <?php if($count_requested_groups_status == 0): ?>
            <p>No pending request to join</p>
            <?php endif; ?>

            <?php
                foreach($user_requested_groups_status as $row):
            ?>
            <p>Group name: <?php echo $row['groupName']; ?></p>
            <p>Status: <?php echo $row['statusCode']; ?></p>
            <hr>
            <?php endforeach; ?>

        </div>
        <div class="col-lg-4 whiteBorderAndBlackLines">
            <h4>Joined groups</h4>
            <?php if($count_joined_groups_status == 0): ?>
            <p>No pending request to join</p>
            <?php endif; ?>

            <?php
                foreach($user_joined_groups_status as $row):
            ?>
            <p>Group name: <?php echo $row['groupName']; ?></p>
            <p>Status: <?php echo $row['statusCode']; ?></p>
            <p>Link to event page: </p>
            <hr>
            <?php endforeach; ?>
        </div>
        <!-- <div class="col-lg-6 whiteBorderAndBlackLines">
            <h4>Available Groups</h4>
            <div class="table-responsive pendingTable">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Group Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Type</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="group-page.php" method="post">
                            <?php if($count_all_approved_events_status == 0) : ?>
                            <tr class="text-center">
                                <td colspan="5">
                                    <h3>No ongoing events</h3>
                                </td>
                            </tr>
                            <?php endif; ?>

                            <?php
                                foreach($event_all_approved as $row):
                            ?>

                            <tr class="table-secondary">
                                <td><?php echo $row['eventName']; ?></td>
                                <td><?php echo $row['eventDescription']; ?></td>
                                <td><?php echo $row['eventType']; ?></td>
                                <td><?php echo $row['startDate']; ?></td>
                                <td><?php echo $row['endDate']; ?></td>
                                <td>
                                    <button type="submit" name="addToPending" class="btn btn-primary"
                                        value="<?php echo $row['eventID']; ?>">
                                        <i class="fa fa-check"></i> Accept
                                    </button>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </form>
                    </tbody>
                </table>
            </div>

        </div> -->
    </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
