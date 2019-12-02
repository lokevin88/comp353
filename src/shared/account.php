<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';


    // include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/admin.php';

    // $admin = new Admin($databaseConnection);
    // $adminID = $admin->getAdminID($user_email);

    // $real_email = $user->getEmail();

    if(isset($_POST['save'])) {
        $newEmail = $_POST['email'];

        $admin->updateEmail($adminID, $newEmail);

        $_SESSION['email'] = $newEmail;
        navigateTo("/comp353/src/shared/account.php");
    }
  ?>

<div id="homepage-wrapper" class="main-body">

  <?php
    $placeholderTitle = "My Account";
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/banner-component.php';
  ?>

  <div class="row-nomargin">
    <div class="col-lg-9"> <!-- change grid size accordingly from the 12 grid -->
        <div class="homepageFeed">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My settings</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="account.php" method="post">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" name="email" id="email"
                            placeholder="<?php echo $user_email?>" title="No blanks">
                        <br>
                        <button type="submit" name="save" class="btn bg-dark text-white" style="float: right;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3"> <!-- change grid size accordingly from the 12 grid -->
      <!-- right side bar -->
    </div>
  </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>