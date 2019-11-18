<!DOCTYPE html>
<html lang="en">
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';


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
                <form>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label text-nowrap">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
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
                    <label for="fname" class="col-sm-2 col-form-label text-nowrap">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter first name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="lname" class="col-sm-2 col-form-label text-nowrap">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter last name">
                    </div>
                  </div>
                  <fieldset class="form-group">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                          <label class="form-check-label text-nowrap" for="gender">
                            Male
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                          <label class="form-check-label text-nowrap" for="gender">
                            Female
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
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