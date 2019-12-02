<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';
    $user = new User($databaseConnection, $user_email);

    $words = "";
    //Checks if something have been sent from the search on the account-page.php
    if(isset($_POST['search'])) {
        $words = $_POST['searchWords'];
    }
    if(isset($_POST['deleteUser'])) {
        $userID = $_POST['deleteUser'];
        $user->deleteUser($userID);
        navigateTo("/comp353/src/pages/listOfUser-page.php");
    }
    //Gets all the users from the search
    $keywords = explode(" ", $words);
    $allCorrespondingUsers = $user->getAllCorrespondingUsers($keywords);
    $count_all_corresponding_users = count($allCorrespondingUsers);
  ?>

<div class="main-body">

  <?php
    $placeholderTitle = "All users found from the search";
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/banner-component.php';
  ?>

  <div class="row-nomargin">
    <div class="col-lg-9"> <!-- change grid size accordingly from the 12 grid -->
        <?php if($count_all_corresponding_users == 0): ?>
        <div class="card">
            <div class="card-body">
                No users matched the names that you searched for
            </div>
        </div>
        <?php else : ?>

        <div class="table-responsive pendingTable">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <form action="listOfUser-page.php" method="post">
                        <?php
                            foreach($allCorrespondingUsers as $row):
                        ?>
                        <tr class="table-secondary">
                            <td><?php echo $row['userID']; ?></td>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><?php echo $row['emailAddress']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td>
                                <button type="submit" name="deleteUser" class="btn btn-danger"
                                    value="<?php echo $row['userID']; ?>">
                                    <i class="fa fa-minus-circle"></i> Delete User
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </form>
                </tbody>
            </table>
        </div>

        <?php endif; ?>
    </div>
    <div class="col-lg-3"> <!-- change grid size accordingly from the 12 grid -->
      <!-- right side bar -->
    </div>
  </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
