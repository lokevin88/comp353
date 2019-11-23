<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/event.php';

    $user = new User($databaseConnection, $user_email);


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

      $event = new Event($databaseConnection, $user_email);
      $event->createEvent($eventArray);
      navigateTo("/comp353/src/pages/homepage.php");
    }

  ?>

<div class="main-body">

  <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/bannerAndMessage-component.php';
  ?>

  <div class="row">
    <div class="col-lg-9">
      <!-- put things here -->
      <?php
        $result = $user->getAllEventNameAndStatus();

        if(is_array($result)) {
          foreach($result as $row) {
            echo $row['username'] . '</br>';
          }
        }

      ?>
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
