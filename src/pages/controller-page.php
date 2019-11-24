<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
    if($user_email != isController) {
        navigateTo("/comp353/src/pages/homepage.php");
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/controller.php';

    $controller = new Controller($databaseConnection);

    $controller_reviewing_result = $controller->getAllReviewingEvents();
    $count_reviewing_result = count($controller_reviewing_result);

  ?>

<div class="controller-wrapper main-body">
  <a name="eventReviewingTableName">List of reviewing events</a>
  <div class="table-responsive ReviewingTable">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">Status</th>
          <th scope="col">Event name</th>
          <th scope="col">Charge rate</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <form action="controller-page.php" method="post">
          <?php if($count_reviewing_result == 0) : ?>
          <tr class="table-secondary text-center">
            <td colspan="4">
              <h3>No reviewing events</h3>
            </td>
          </tr>
          <?php endif; ?>

          <?php
              foreach($controller_reviewing_result as $row):
          ?>

          <tr class="table-secondary">
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['statusCode']; ?></td>
            <td><?php echo $row['eventName']; ?></td>
            <td><input type="number" class="form-control" name="chargeRate" id="chargeRate" placeholder="price"
                        required>
            <td>
              <button type="submit" name="addToAccepted" class="btn btn-primary" value="<?php echo $row['eventID']; ?>">
                <i class="fa fa-check"></i> Accept
              </button>
            </td>
          </tr>
          <?php endforeach; ?>
        </form>
      </tbody>
    </table>
  </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
