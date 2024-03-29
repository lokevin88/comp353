<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/event.php';

    $eventID = $_GET['id'];
    //hotfix ...... navigateTo does not work in the newsfeed component for replying
    $path = "<script>window.location = '/comp353/src/pages/eventTemplate/event-template1.php?id=$eventID';</script>";

    $user = new User($databaseConnection, $user_email);

    $event = new Event($databaseConnection, $user_email);

    $placeholderTitle = $event->getEventName($eventID);

    // all posting in events
    $event_all_member_posting = $event->getAllPostsFromEvent($eventID);
    $count_all_member_posting = count($event_all_member_posting);

    if(isset($_POST['submitEventPost'])) {
      $body_content = $_POST['message_content'];

      $user->submitEventPosts($eventID, $body_content);
      navigateTo("/comp353/src/pages/eventTemplate/event-template1.php?id=$eventID");
    }
  ?>

<div id="event-template-wrapper" class="main-body">

  <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/bannerAndMessage-component.php';
  ?>

  <div class="row">
    <div class="col-lg-12">
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/event-newsfeed-component.php';
      ?>

    </div>
  </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
