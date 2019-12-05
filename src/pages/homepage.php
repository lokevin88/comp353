<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';
    include_once($_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/event.php');

    if($isAdmin) {
      navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/admin-page.php");
    }

    $placeholderTitle = 'Homepage';

    $user = new User($databaseConnection, $user_email);
    $user_managed_events_status = $user->getManagedEventNameAndStatusLIMIT();
    $count_managed_events_result = count($user_managed_events_status);

    $user_status_events = $user->getAllRequestedEventsLIMIT();
    $count_status_events = count($user_status_events);

    $user_going_events = $user->getAllGoingEvents();
    $count_going_events = count($user_going_events);

    $user_joined_groups = $user->getAllJoinedGroups();
    $count_joined_groups = count($user_joined_groups);


    $eventLength = "must be between 5 and 50 characters";
    $eventDescriptionLength = "must be between 5 and 100 characters";
    $eventNumberFormat = "format should be as follows xxx-xxx-xxxx";
    $eventNumberFormatRegex = "/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
    $eventDateCheck = "choose proper start and end dates";
    $errors = array();

    if(isset($_POST['createEvent'])) {
      $eventName = $_POST['eventName'];
      $eventDescription = $_POST['eventDescription'];
      $eventPhoneNumber = $_POST['eventPhoneNumber'];
      $eventType = $_POST['eventType'];
      $eventSize = $_POST['eventSize'];
      $eventStartDate = $_POST['eventStartDate'];
      $eventEndDate = $_POST['eventEndDate'];
      $pageTemplate = $_POST['pageTemplate'];

      if(strlen($eventName) < 5 || strlen($eventName) > 50) {
        array_push($errors, $eventLength);
      }

      if(strlen($eventDescription) < 5 || strlen($eventDescription) > 100) {
        array_push($errors, $eventDescriptionLength);
      }

      if(!preg_match($eventNumberFormatRegex, $eventPhoneNumber)) {
        array_push($errors, $eventNumberFormat);
      }

      if($eventStartDate > $eventEndDate) {
        array_push($errors, $eventDateCheck);
      }


      if(empty($errors)) {
        $eventArray = array($eventName, $eventDescription, $eventPhoneNumber, $eventType, $eventSize, $eventStartDate, $eventEndDate, $pageTemplate);

        $user->createEvent($eventArray);
        navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/homepage.php");
      }
    }

    if(isset($_POST['createGroup'])) {
      $groupName = $_POST['groupName'];
      $groupDescription = $_POST['groupDescription'];
      $eventID = $_POST['eventID'];

      $groupArray = array($groupName, $groupDescription, $eventID);

      $user->createGroup($groupArray);
      navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/group-page.php");
  }

  ?>

<div id="homepage-wrapper" class="main-body">

  <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/banner-component.php';
  ?>

  <div class="row">
    <div class="col-lg-9">
      <div class="homepageFeed">
        <div class="row">
          <div class="col-lg-12">
            <h2>Feeds from joined events and groups</h2>
            <?php echo $user_email; ?>
            <?php echo $_SESSION['email']; ?>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <?php if($count_going_events == 0): ?>
            <div class="card mt-3">
              <div class="card-body">
                <div class="card-title">Not in an event</div>
              </div>
            </div>
            <?php endif; ?>

            <?php
                foreach($user_going_events as $row):
            ?>
            <div class="card mt-3">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['eventName']; ?></h5>
                <p class="card-text"><?php echo $row['eventDescription']; ?></p>
                <a href="<?php echo "{$row['pageTemplate']}?id={$row['eventID']}" ; ?>" class="btn btn-primary">Visit
                  the event page</a>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="col-lg-6">
            <?php if($count_joined_groups == 0): ?>
            <div class="card mt-3">
              <div class="card-body">
                <div class="card-title">Not in a group</div>
              </div>
            </div>
            <?php endif; ?>

            <?php
                foreach($user_joined_groups as $row):
            ?>
            <div class="card mt-3">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['groupName']; ?></h5>
                <p class="card-text"><?php echo $row['groupDescription']; ?></p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

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
