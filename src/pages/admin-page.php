<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
    if($user_email != isAdmin) {
        navigateTo("/comp353/src/pages/homepage.php");
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/admin.php';

    $admin = new Admin($databaseConnection);
  ?>

<div class="main-body">
    <?php
      $result = $admin->getAllPendingEvents();


      if(is_array($result)) {
        foreach($result as $row) {
          echo $row['username'] . '</br>';
        }
      }
    ?>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
