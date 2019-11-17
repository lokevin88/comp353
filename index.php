<!DOCTYPE html>
<html lang="en">
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';
  ?>

<body class="vh-100">
  <div id="login-wrapper" class="bg-dark">
    <div class="container-fluid">
      <div class="row vh-100">
        <div class="col-8">
          <div class="introduction">
            <div class="row">
              <h1>rr_comp_353_2</h1>
            </div>
            <div class="row">
              <h2>Database</h2>
            </div>
          </div>
        </div>

        <div class="col-4 bg-light ">
          <div class="form-wrapper text-dark">
            <div class="form-container">
              <div class="row">
                <h1>Sign In</h1>
              </div>
              <div class="row">
                <form action="index.php" method="post">
                  <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Enter email" required />
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="pwd" placeholder="Enter password" required />
                  </div>

                  <button type="submit" class="btn btn-dark">Submit</button>
                </form>
              </div>
              <div class="row">
                <a href="#">register</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>