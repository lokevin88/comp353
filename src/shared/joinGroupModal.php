<?php

    // include $_SERVER['DOCUMENT_ROOT'] . 'https://rrc353.encs.concordia.ca/comp353/src/libs/user.php';

    // $user = new User($databaseConnection, $user_email);

    /////////TESTING///////
    // SELECT DISTINCT g.groupName, g.groupID
    // FROM groups g
    // INNER JOIN group_member_list gml ON g.groupID = gml.groupID
    // INNER JOIN event_list el ON g.eventID = el.eventID
    // WHERE gml.userID != '$userID'
    //////////////////////

    $user_available_groups = $user->getAllAvailableGroups();
?>

<div class="modal fade" id="joinGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="group-page.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Join Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="groupDescription">Choose the group you wish to join</label>
                        <select class="form-control" id="groupID" name="groupID">
                            <?php
                                foreach($user_available_groups as $row):
                            ?>
                            <option value="<?php echo $row['groupID']; ?>"><?php echo $row['groupName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="joinGroup" class="btn bg-dark text-white">Join</button>
                </div>
            </form>
        </div>
    </div>
</div>
