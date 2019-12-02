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
                        <?php if($isGroupManager == true) : ?>
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
