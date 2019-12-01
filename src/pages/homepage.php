<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/event.php';

    $placeholderTitle = 'Homepage';

    $user = new User($databaseConnection, $user_email);
    $user_managed_events_status = $user->getManagedEventNameAndStatusLIMIT();
    $count_managed_events_result = count($user_managed_events_status);

    $user_status_events = $user->getAllRequestedEventsLIMIT();
    $count_status_events = count($user_status_events);

    $user_status_groups = $user->getAllRequestedGroupsLIMIT();
    $count_status_groups = count($user_status_groups);

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
      navigateTo("/comp353/src/pages/homepage.php");
    }

  ?>

<div class="main-body">

  <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/banner-component.php';
  ?>

  <div class="row">
    <div class="col-lg-9">
      <!-- put things here -->

    </div>
    <div class="col-lg-3">
      <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/commonGroupAndEvent-component.php';
      ?>
    </div>
  </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
