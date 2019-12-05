<?php

    // include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/user.php';

    // $user = new User($databaseConnection, $user_email);
    $user_managed_events = $user->getManagedEventsNameAndID();
?>

<div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="groupName">Group Name</label>
                        <input type="text" class="form-control" name="groupName" id="groupName"
                            placeholder="Enter group name" title="No blanks" required>

                        <?php if(in_array($groupNameLength, $errors)): ?>
                        <div class="text-danger">
                        <?php echo $groupNameLength; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="groupDescription">Description</label>
                        <input type="text" class="form-control" name="groupDescription" id="groupDescription"
                            placeholder="Enter description" title="No blanks" required>

                        <?php if(in_array($groupDescriptionLength, $errors)): ?>
                        <div class="text-danger">
                        <?php echo $groupDescriptionLength; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="groupDescription">Related to Event</label>
                        <select class="form-control" id="eventID" name="eventID">
                            <?php
                                foreach($user_managed_events as $row):
                            ?>
                            <option value="<?php echo $row['eventID']; ?>"><?php echo $row['eventName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="createGroup" class="btn bg-dark text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
