<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here 
    if($user_email != isController) {
        navigateTo("/comp353/src/pages/homepage.php");
    }
  ?>

<div class="main-body">

</div>

<?php

    //  always import from above here  
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
  