<?php
    //MODAL FOR CREATING GROUP
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/paymentDetailsModal.php';

    // include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/libs/event.php';
?>

<h4>Managed Event and Status</h4>
<?php if($count_managed_events_result == 0): ?>
<p>Not managing any events</p>
<?php endif; ?>

<?php
    foreach($user_managed_events_status as $row):
        $amountDue = $event->getEventFee($row['eventFeeID']);
?>
<p>Event name: <?php echo $row['eventName']; ?></p>
<p>Status: <?php echo $row['statusCode']; ?></p>
<?php if($row['statusCode'] == "APPROVED" || $row['statusCode'] == "PAYMENTREQUESTED"): ?>
<p>Link to event page:<a href="<?php echo "{$row['pageTemplate']}?id={$row['eventID']}" ; ?>"> Click here</a></p>
    <?php if($row['statusCode'] == "PAYMENT") : ?>
        <label for="amount">Amount Due: <?php echo $amountDue ?>$</label>
        <button type="button" class="btn btn-lg bg-dark text-white" data-toggle="modal"
            data-target="#paymentDetailsModal">Enter Payment Details</button>
    <?php endif; ?>
<?php endif; ?>
<hr>
<?php endforeach; ?>
<form name="_xclick" target="event-page.php" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png" alt="Check out with PayPal" >
</form>
