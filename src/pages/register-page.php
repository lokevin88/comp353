<!DOCTYPE html>
<html lang="en">
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';

    if(isset($_POST['register'])) {
      $email = $_POST['email'];
      $username = $_POST['username'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $gender = $_POST['gender'];
      $dob = $_POST['dob'];
      $profilePic = "/comp353/src/assets/images/mockuser.png";
      $pwd = $_POST['pwd'];

      echo $username;
      echo $dob;

      $emailResult_query = mysqli_query($databaseConnection, "SELECT * FROM user where emailAddress='$email'");
      $emailResult_rows = mysqli_num_rows($emailResult_query);

      if($emailResult_rows) {
        // call jsfunction to display message PLACEHOLDER
        echo 'display something saying email exists already';
      }
      else {
        $register_query = mysqli_query($databaseConnection, "INSERT INTO user (emailAddress, username, firstName, lastName, gender, dob, profilePicture, password) VALUES
        ('$email', '$username', '$fname', '$lname', '$gender', '$dob', '$profilePic', '$pwd')");
        navigateTo("/comp353/index.php");
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
                <h1>Register</h1>
              </div>
              <div class="row-nomargin margin-30">
                <form action="register-page.php" method="POST">
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-nowrap">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" placeholder="test@hotmail.com" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-2 col-form-label text-nowrap">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="fname" id="fname" placeholder="John">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="lname" class="col-sm-2 col-form-label text-nowrap">LastName</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="lname" id="lname" placeholder="Doe">
                    </div>
                  </div>
                  <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gender" id="gender" value="male" required>
                          <label class="form-check-label text-nowrap" for="gender">
                            Male
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gender" id="gender" value="female"
                            required>
                          <label class="form-check-label text-nowrap" for="gender">
                            Female
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <div class="form-group row">
                    <label for="dob" class="col-sm-2 col-form-label text-nowrap">Date of Birth</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="dob" id="dob"
                        required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label text-nowrap">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" id="username" placeholder="JohnDoe"
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
                      <button class="btn bg-dark text-white" name="register" type="submit">Register</button>
                    </div>
                  </div>
                </form>
              </div>
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
