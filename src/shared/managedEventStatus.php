<h4>Managed Event and Status</h4>
<?php if($count_managed_events_result == 0): ?>
<p>Not managing any events</p>
<?php endif; ?>

<?php
    foreach($user_managed_events_status as $row):
?>
<p>Event name: <?php echo $row['eventName']; ?></p>
<p>Status: <?php echo $row['statusCode']; ?></p>
<p>Link to event page: </p>
<hr>
<?php endforeach; ?>
