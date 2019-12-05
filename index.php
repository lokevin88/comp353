
<?php
    require './comp353/src/shared/head.php';

    include './comp353/src/libs/admin.php';

    $admin = new Admin($databaseConnection);

    $homepage = '';
    $error = '';

    if(isset($_POST['login'])) {
      $email = $_POST['email'];
      $pwd = $_POST['pwd'];

      $adminID = $admin->getAdminID($email);
      $isAdmin = false;
      if(!empty($adminID)) {
        $isAdmin = true;
      }

      if($isAdmin) {
        $query = mysqli_query($databaseConnection, "SELECT * FROM admin where emailAddress='$email' AND password='$pwd'");
        $homepage = "https://rrc353.encs.concordia.ca/comp353/src/pages/admin-page.php";
      }
      else if($email == isController) {
        $query = mysqli_query($databaseConnection, "SELECT * FROM controller where emailAddress='$email' AND password='$pwd'");
        $homepage = "https://rrc353.encs.concordia.ca/comp353/src/pages/controller-page.php";
      }
      else {
        $query = mysqli_query($databaseConnection, "SELECT * FROM user where emailAddress='$email' AND password='$pwd'");
        $homepage = "https://rrc353.encs.concordia.ca/comp353/src/pages/homepage.php";
      }

      $user_rows = mysqli_num_rows($query);

      if($user_rows) {
        $_SESSION['email'] = $email;
        $error = '';
        navigateTo($homepage);
      } else {
        $error = "Input of email or password is incorrect!";
      }
    }
?>
<body class="vh-100">
  <div id="login-wrapper" class="bg-dark">
    <div class="container-fluid">
      <div class="row vh-100">
        <div class="col-md-8">
          <div class="introduction">
            <div class="row">
              <h1 style="color: snow;"><a href="https://rrc353.encs.concordia.ca/comp353/index.php">rr_comp_353_2</a></h1>
            </div>
            <div class="row">
              <h2>Database</h2>
            </div>
            <div class="row">
              <p>Brian, Cindy, Cherry, Kevin</p>
            </div>
          </div>
        </div>

        <div class="col-md-4 bg-light ">
          <div class="form-wrapper text-dark">
            <div class="form-container">
              <div class="row-nomargin margin-30">
                <h1>Sign in</h1>
              </div>
              <div class="row-nomargin margin-30">
                <form action="index.php" method="POST">
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-nowrap">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                        required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pwd" class="col-sm-2 col-form-label text-nowrap">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password"
                        required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button class="btn bg-dark text-white" name="login" type="submit">Sign In</button>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <a href="https://rrc353.encs.concordia.ca/comp353/src/pages/register-page.php">Register</a>
                    </div>
                  </div>
                </form>
                <div class="row">
                    <div class="col-sm-12 text-danger">
                      <?php echo $error; ?>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php
    require './comp353/src/shared/jsScript.php';
  ?>
