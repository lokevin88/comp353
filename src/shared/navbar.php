
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';
    
    if(!isset($_SESSION['email'])) {
      navigateTo("/comp353/index.php");  
    } else {
      $user_email = $_SESSION['email'];
      $user_query = mysqli_query($databaseConnection, "SELECT * FROM user where emailAddress='$user_email'");
      $user_data_row = mysqli_fetch_array($user_query);

    }
  ?>

<body>
  <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <a class="navbar-brand" href="#">rr_comp353_2</a>

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
      <div class="row px-4">
        <span class="logout">
          <a href="/comp353/src/shared/logout.php">logout</a>
        </span>
      </div>

      <hr>

      <div class="row px-4" style="transform: rotate(0);">
        <a href="#" class="stretched-link">my account</a>
      </div>

      <hr>

      <div class="row px-4" style="transform: rotate(0);">
        <span>
          <a href="#" class="stretched-link">Events</a>
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