<?php
    require $_SERVER['DOCUMENT_ROOT'] . './comp353/src/shared/navbar.php';
    //  always import from below here

    if($isAdmin == false) {
        navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/homepage.php");
    }

    $admin_pending_result = $admin->getAllPendingEvents();
    $count_pending_result = count($admin_pending_result);

    $admin_allEventStatus_result = $admin->getAllEventsStatus();
    $count_allEventStatus_result = count($admin_allEventStatus_result);

    if(isset($_POST['addToReviewing'])) {
      $eventID = $_POST['addToReviewing'];

      $admin->updateEventManagerStatus($eventID, 'REVIEWING');
      navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/admin-page.php");
    }

    if(isset($_POST['addToRejected'])) {
      $eventID = $_POST['addToRejected'];

      $admin->updateEventManagerStatus($eventID, 'REJECTED');
      navigateTo("https://rrc353.encs.concordia.ca/comp353/src/pages/admin-page.php");
    }
  ?>

<div id="admin-wrapper" class="main-body">
  <div class="row">
    <div class="col-md-8">
      <a name="eventPendingTableName">List of pending events</a>
      <div class="table-responsive pendingTable">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Username</th>
              <th scope="col">Status</th>
              <th scope="col">Event name</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <form action="admin-page.php" method="post">
              <?php if($count_pending_result == 0) : ?>
              <tr class="table-secondary text-center">
                <td colspan="5">
                  <h3>No pending events</h3>
                </td>
              </tr>
              <?php endif; ?>

              <?php
              foreach($admin_pending_result as $row):
              ?>

              <tr class="table-secondary">
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['statusCode']; ?></td>
                <td><?php echo $row['eventName']; ?></td>
                <td>
                  <button type="submit" name="addToReviewing" class="btn btn-primary"
                    value="<?php echo $row['eventID']; ?>">
                    <i class="fa fa-check"></i> Accept
                  </button>
                </td>
                <td>
                  <button type="submit" name="addToRejected" class="btn btn-danger"
                    value="<?php echo $row['eventID']; ?>">
                    <i class="fa fa-minus-circle"></i> Reject
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>
            </form>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <a name="eventStatusTableName">List of all events status</a>
      <div class="table-responsive pendingTable">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Event name</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if($count_allEventStatus_result == 0) : ?>
            <tr class="table-secondary text-center">
              <td colspan="2">
                <h3>No events</h3>
              </td>
            </tr>
            <?php endif; ?>
            <?php
                foreach($admin_allEventStatus_result as $row):
              ?>
            <tr class="table-secondary">
              <td><?php echo $row['eventName']; ?></td>
              <td><?php echo $row['statusCode']; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="report">
    <a name="reportableName">User reports</a>
    <div class="col-md-4">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Total</th>
            <th scope="col">Count</th>
          </tr>
        </thead>
          <tbody class="table-secondary">
            <tr><td>Number of users</td>
              <td><?php $result = mysqli_query($databaseConnection, "SELECT * FROM user");
                if (mysqli_num_rows($result) > 0) {
                  echo count(mysqli_fetch_all($result, MYSQLI_ASSOC));
                } ?>
              </td>
            </tr>
            <tr><td>Number of events</td>
              <td><?php $result = mysqli_query($databaseConnection, "SELECT * FROM event");
                if (mysqli_num_rows($result) > 0) {
                  echo count(mysqli_fetch_all($result, MYSQLI_ASSOC));
                } ?>
              </td>
            </tr>
            <tr><td>Number of groups</td>
              <td><?php $result = mysqli_query($databaseConnection, "SELECT * FROM groups");
              if (mysqli_num_rows($result) > 0) {
                echo count(mysqli_fetch_all($result, MYSQLI_ASSOC));
              } ?>
              </td>
            </tr>
          </tbody>
      </table>
    </div>

  <?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . './comp353/src/shared/jsScript.php';
  ?>
