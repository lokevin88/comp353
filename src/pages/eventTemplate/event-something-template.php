<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
  ?>

<div class="main-body">

  <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/bannerAndMessage-component.php';
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
