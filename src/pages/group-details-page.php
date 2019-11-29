<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/navbar.php';

    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/group.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';

    $group = new Group($databaseConnection);
    $user = new User($databaseConnection, $user_email);

    // For the title
    $idRaw = $_SERVER['QUERY_STRING'];
    // groupID= is of length 8, subtringing it with give the ID
    $groupID = substr($idRaw, 8);
    $groupName = $group->getGroupName($groupID);
    $title ="<h1 class='display-4'> Welcome to $groupName Group</h1>";

    // For getting the list of members from that specific group
    $listMembers = $group->getListMembers($groupID);
    $countListMembers = count($listMembers);
    $subtitle = "List of members from " . $groupName . " group:";

    // For checking if the current user is the manager of the group
    $groupManagerID = $group->checkIfUserIsManager($groupID);
    $userID = $user->getUserID();
    $isGroupManager = false;
    if ($groupManagerID == $userID) {
        $isGroupManager = true;
    }

    if(isset($_POST['deleteMember'])) {
        $memberUserID = $_POST['deleteMember'];
        $group->deleteMember($memberUserID);
        navigateTo("/comp353/src/pages/group-page.php");
    }

?>

<div class="main-body">
<div class="jumbotron">
    <?php echo $title?>
    <hr class="my-4">
</div>

  <div class="row-nomargin">
    <div class="col-lg-9"> <!-- change grid size accordingly from the 12 grid -->
      <!-- put main things here -->
      POST GOES HERE

    </div>
    <div class="col-lg-3"> <!-- change grid size accordingly from the 12 grid -->
      <!-- right side bar -->
      <div class="commonGroupAndEventSide">
        <h4><?php echo $subtitle ?></h4>
        <table style="width:100%">
            <thead class="thead-dark">
                <?php if($countListMembers != 0) : ?>
                    <tr>
                        <th scope="col" style="width:38%">FirstName:</th>
                        <th scope="col" style="width:38%">LastName:</th>
                        <th scope="col" style="width:24%"></th>
                    </tr>
                <?php endif; ?>
            </thead>
            <tbody>
                <form action="group-details-page.php" method="post">
                    <?php if($countListMembers == 0) : ?>
                    <tr class="table-secondary text-center">
                        <td colspan="6">
                            <h3>No one has joined your group yet</h3>
                        </td>
                    </tr>
                    <?php else : ?>
                        <?php
                            foreach($listMembers as $row):
                        ?>
                        <tr class="table-secondary">
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <?php if($isGroupManager == false) : ?>
                                <td><?php echo $row['statusCode']; ?></td>
                            <?php else : ?>
                                <td>
                                    <button type="submit" name="deleteMember" class="btn btn-danger"
                                        value="<?php echo $row['userID']; ?>">DELETE
                                    </button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </form>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php

    //  always import from above here
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/jsScript.php';
  ?>
