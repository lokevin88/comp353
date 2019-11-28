<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/event.php';

    $user = new User($databaseConnection, $user_email);
    // get all managed events
    $user_managed_events_status = $user->getManagedEventNameAndStatus();
    $count_managed_events_result = count($user_managed_events_status);
    // get all requested to join events
    $user_requested_events_status = $user->getAllPendingRequestedEvents();
    $count_requested_events_status = count($user_requested_events_status);
    // get all requestee who wants to join your event
    $user_request_to_join_events_status = $user->getAllPendingRequestToEvents();
    $count_request_to_join_events_status = count($user_request_to_join_events_status);
    // get all going and approved events
    $user_going_events_status = $user->getAllGoingEvents();
    $count_going_events_status = count($user_going_events_status);

    $event = new Event($databaseConnection, $user_email);
    $event_all_approved = $event->getAllApprovedEvents();
    $count_all_approved_events_status = count($event_all_approved);


    if(isset($_POST['createEvent'])) {
      $eventName = $_POST['eventName'];
      $eventDescription = $_POST['eventDescription'];
      $eventPhoneNumber = $_POST['eventPhoneNumber'];
      $eventType = $_POST['eventType'];
      $eventSize = $_POST['eventSize'];
      $eventStartDate = $_POST['eventStartDate'];
      $eventEndDate = $_POST['eventEndDate'];
      $pageTemplate = $_POST['pageTemplate'];

      $eventArray = array($eventName, $eventDescription, $eventPhoneNumber, $eventType, $eventSize, $eventStartDate, $eventEndDate, $pageTemplate);

      $user->createEvent($eventArray);
      navigateTo("/comp353/src/pages/event-page.php");
    }

    if(isset($_POST['addToPending'])) {
        $eventID = $_POST['addToPending'];

        $user->joinEvent($eventID);
        navigateTo("/comp353/src/pages/event-page.php");
    }

    if(isset($_POST['addToApproved'])) {
        $eventID = $_POST['addToApproved'];
        $userID = $_POST['userToAccept'];

        $user->updateRequestedPeopleToJoinEvent($eventID, $userID, 'APPROVED');
        navigateTo("/comp353/src/pages/event-page.php");
    }

    if(isset($_POST['addToRejected'])) {
        $eventID = $_POST['addToRejected'];
        $userID = $_POST['userToAccept'];

        $user->updateRequestedPeopleToJoinEvent($eventID, $userID, 'REJECTED');
        navigateTo("/comp353/src/pages/event-page.php");
    }
  ?>

<div id="event-wrapper" class="main-body">

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/bannerAndEvent-component.php';
  ?>

    <div class="row-nomargin">
        <div class="col-lg-12">
            <a name="eventPendingTableName">List of people who wants to join your event</a>
            <div class="table-responsive pendingTable">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Status</th>
                            <th scope="col">Event name</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="event-page.php" method="post">
                            <?php if($count_request_to_join_events_status == 0) : ?>
                            <tr class="table-secondary text-center">
                                <td colspan="6">
                                    <h3>No one wants to join your events as of yet</h3>
                                </td>
                            </tr>
                            <?php endif; ?>

                            <?php
                                foreach($user_request_to_join_events_status as $row):
                            ?>

                            <tr class="table-secondary">
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['statusCode']; ?></td>
                                <td><?php echo $row['eventName']; ?></td>
                                <td>
                                    <button type="submit" name="addToApproved" class="btn btn-primary"
                                        value="<?php echo $row['eventID']; ?>">
                                        <i class="fa fa-check"></i> Accept
                                    </button>
                                </td>
                                <td>
                                    <button type="submit" name="addToRejected" class="btn btn-danger"
                                        value="<?php echo $row['eventID']; ?>">
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
        <div class="col-lg-2 whiteBorderAndBlackLines">
            <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/managedEventStatus.php';
            ?>
        </div>
        <div class="col-lg-2 whiteBorderAndBlackLines">
            <h4>Pending to join</h4>
            <?php if($count_requested_events_status == 0): ?>
            <p>No pending request to join</p>
            <?php endif; ?>

            <?php
                foreach($user_requested_events_status as $row):
            ?>
            <p>Event name: <?php echo $row['eventName']; ?></p>
            <p>Status: <?php echo $row['statusCode']; ?></p>
            <hr>
            <?php endforeach; ?>

        </div>
        <div class="col-lg-2 whiteBorderAndBlackLines">
            <h4>Going events</h4>
            <?php if($count_going_events_status == 0): ?>
            <p>No pending request to join</p>
            <?php endif; ?>

            <?php
                foreach($user_going_events_status as $row):
            ?>
            <p>Event name: <?php echo $row['eventName']; ?></p>
            <p>Status: <?php echo $row['statusCode']; ?></p>
            <?php if( ($row['statusCode']) == "APPROVED"): ?>
            <p>Link to event page:<a href="<?php echo "{$row['pageTemplate']}?id={$row['eventID']}" ; ?>"> Click here</a></p>
            <?php endif; ?>
            <hr>
            <?php endforeach; ?>
        </div>
        <div class="col-lg-6 whiteBorderAndBlackLines">
            <h4>Ongoing events</h4>
            <div class="table-responsive pendingTable">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Event</th>
                            <th scope="col">Description</th>
                            <th scope="col">Type</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="event-page.php" method="post">
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

        </div>
    </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
