<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';
    //  always import from below here
    if($user_email != isAdmin) {
        navigateTo("/comp353/src/pages/homepage.php");
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/admin.php';

    $admin = new Admin($databaseConnection);
    $admin_pending_result = $admin->getAllPendingEvents();
  ?>

<div id="admin-wrapper" class="main-body">
  <a name="pedingTableName">List of pending events</a>
  <div class="table-responsive pendingTable">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Username</th>
          <th scope="col">StatusCode</th>
          <th scope="col">Event name</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <form action="admin-page.php" method="post">
          <?php

          foreach($admin_pending_result as $row):

        ?>
          <tr class="table-secondary">
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['statusCode']; ?></td>
            <td><?php echo $row['eventName']; ?></td>
            <td>
              <button type="submit" name="addToReview" class="btn btn-primary">
                <i class="fa fa-check"></i> Accept
              </button>
            </td>
            <td>
              <button type="submit" name="addToDecline" class="btn btn-danger">
                <i class="fa fa-minus-circle"></i> Delete
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
