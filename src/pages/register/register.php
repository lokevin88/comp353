<!DOCTYPE html>
<html lang="en">
  <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';
  ?>
  <body>
    <form>
      <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input
          type="email"
          class="form-control"
          id="inputEmail"
          placeholder="Enter email"
          required
        />
      </div>
      <div class="form-group">
        <label for="fname">First name</label>
        <input
          type="text"
          class="form-control"
          id="fname"
          placeholder="enter first name"
          required
        />
      </div>
      <div class="form-group">
        <label for="lname">Last name</label>
        <input
          type="text"
          class="form-control"
          id="lname"
          placeholder="enter last name"
          required
        />
      </div>
      <div class="form-group">
        <label for="inputPassword">Password</label>
        <input
          type="password"
          class="form-control"
          id="inputPassword"
          placeholder="Password"
          required
        />
      </div>

      <div class="form-group">
        <label for="inputConfirmPassword">Confirm password</label>
        <input
          type="password"
          class="form-control"
          id="inputConfirmPassword"
          placeholder="Confirm password"
          required
        />
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
