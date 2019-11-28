<h4>Managed Event and Status</h4>
<?php if($count_managed_events_result == 0): ?>
<p>Not managing any events</p>
<?php endif; ?>

<?php
    foreach($user_managed_events_status as $row):
?>
<p>Event name: <?php echo $row['eventName']; ?></p>
<p>Status: <?php echo $row['statusCode']; ?></p>
<?php if($row['statusCode'] == "APPROVED"): ?>
<p>Link to event page:<a href="<?php echo "{$row['pageTemplate']}?id={$row['eventID']}" ; ?>"> Click here</a></p>
<?php endif; ?>
<hr>
<?php endforeach; ?>
