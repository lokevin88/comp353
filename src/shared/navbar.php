<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';

    include_once($_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/admin.php');

    $admin = new Admin($databaseConnection);

    if(!isset($_SESSION['email'])) {
      navigateTo("/comp353/index.php");
    } else {
      $user_email = $_SESSION['email'];

      $adminID = $admin->getAdminID($user_email);
      $isAdmin = false;
      if(!empty($adminID)) {
        $isAdmin = true;
      }
      if($isAdmin) {
        $query = mysqli_query($databaseConnection, "SELECT * FROM admin where emailAddress='$user_email'");
      }
      else if($user_email == isController) {
        $query = mysqli_query($databaseConnection, "SELECT * FROM controller where emailAddress='$user_email'");
      }
      else {
        $query = mysqli_query($databaseConnection, "SELECT * FROM user where emailAddress='$user_email'");
      }

      $user_data_row = mysqli_fetch_array($query);

    }
  ?>

<body>
  <div id="globalError"></div>
  <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <a class="navbar-brand" href="/comp353/src/pages/homepage.php">rr_comp353_2</a>

    <div class="d-flex flex-fill justify-content-end">

      <a class="nav-link text-white" href="#">NotificationPlaceHolder</a>
      <a class="nav-link text-white" href="#">MessengerPlaceHolder</a>
    </div>
  </nav>

  <div class="sideNavBar text-black">
    <div class="container">
      <div class="row my-3 justify-content-center">
        <img src="<?php echo $user_data_row['profilePicture']; ?>" alt="mock"
          class="img-fluid img-thumbnail profile-wrap shadow-sm">
      </div>

      <div class="row px-4">
        <span>
          <p class="profile-name">Hey <?php echo $user_data_row['username']; ?></p>
        </span>
      </div>
      <div class="row px-4 logout">
        <div class="col-md-12">
          <a href="/comp353/src/pages/account-page.php" class="stretched-link">My account</a>
        </div>
        <div class="col-md-12">
          <a href="/comp353/src/shared/logout.php">logout</a>
        </div>
      </div>

      <hr>

      <div class="row px-4" style="transform: rotate(0);">
        <a href="/comp353/src/pages/homepage.php" class="stretched-link">Home</a>
      </div>

      <hr>

      <div class="row px-4" style="transform: rotate(0);">
        <span>
          <a href="/comp353/src/pages/event-page.php" class="stretched-link">Events</a>
        </span>
      </div>

      <hr>

      <div class="row px-4" style="transform: rotate(0);">
        <span>
          <a href="/comp353/src/pages/group-page.php" class="stretched-link">Groups</a>
        </span>
      </div>

      <hr>

      <div class="row px-4" style="transform: rotate(0);">
        <span>
          <a href="#" class="stretched-link">something</a>
        </span>
      </div>

      <hr>

      <div class="row px-4" style="transform: rotate(0);">
        <span>
          <a href="#">something</a>
        </span>
      </div>

      <hr>

    </div>

    <div class="footer-wrapper d-flex justify-content-center">
      <p>© Copyright 2019 | All Rights Reserved | rr_comp353_2 </p>
    </div>
  </div>
