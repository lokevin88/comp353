<!DOCTYPE html>
<html lang="en">
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';

    if(isset($_POST['login'])) {
      $email = $_POST['email'];
      $pwd = $_POST['pwd'];

      $user_query = mysqli_query($databaseConnection, "SELECT * FROM user where emailAddress='$email' AND password='$pwd'");
      $user_rows = mysqli_num_rows($user_query);

      if($user_rows) {
        $row = mysqli_fetch_array($user_query);
        $username = $row['username'];

        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        navigateTo("/comp353/src/pages/homepage.php"); 
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
              <h1>rr_comp_353_2</h1>
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
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pwd" class="col-sm-2 col-form-label text-nowrap">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <button class="btn bg-dark text-white" name="login" type="submit">Sign In</button>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <a href="/comp353/src/pages/register-page.php">Register</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>

  <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>

</html>
