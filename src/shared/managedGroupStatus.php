<h4>Managed Groups and Status</h4>
<?php if($count_managed_groups_result == 0): ?>
<p>Not managing any groups</p>
<?php endif; ?>

<?php
    foreach($user_managed_groups as $row):
?>
<p>Group name: <?php echo $row['groupName']; ?></p>
<p>Status: <?php echo $row['groupDescription']; ?></p>
<p>Link to group page: </p>
<hr>
<?php endforeach; ?>

<!-- //TO CHANGE variables name-->
