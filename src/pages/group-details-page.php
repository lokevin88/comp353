<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    $idRaw = $_SERVER['QUERY_STRING'];
    // groupID= is of length 8, subtringing it with give the ID
    $id = substr($idRaw, 8);

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';

    // For the title
    $title ="<h1 class='display-4'> Welcome to Group $id</h1>";
  ?>

<div class="main-body">
<?php echo "hellloooo" .$id ?>
<div class="jumbotron">
    <?php echo $title?>
    <hr class="my-4">
</div>

  <div class="row-nomargin">
    <div class="col-lg-9"> <!-- change grid size accordingly from the 12 grid -->
      <!-- put main things here -->
      nfkdfjkdslfjklsdjfkldsj

    </div>
    <div class="col-lg-3"> <!-- change grid size accordingly from the 12 grid -->
      <!-- right side bar -->
      fdksfhklshf.ksdhfks
    </div>
  </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
