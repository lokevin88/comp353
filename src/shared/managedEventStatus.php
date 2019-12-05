<?php
    //MODAL FOR CREATING GROUP
    include $_SERVER['DOCUMENT_ROOT'] . './comp353/src/shared/paymentDetailsModal.php';

    $event = new Event($databaseConnection, $user_email);

?>

<h4>Managed Event and Status</h4>
<?php if($count_managed_events_result == 0): ?>
<p>Not managing any events</p>
<?php endif; ?>

<?php
    foreach($user_managed_events_status as $row):
        if(isset($row['eventFeeID'])) {
            $amountDue = $event->getEventFee($row['eventFeeID']);
        }
        $eventManagerID = $user->getEventManagerIDByEventID($row['eventID']);
?>
<p>Event name: <?php echo $row['eventName']; ?></p>
<p>Status: <?php echo $row['statusCode']; ?></p>
<?php if($row['statusCode'] == "APPROVED" || $row['statusCode'] == "PAYMENT"): ?>
<p>Link to event page:<a href="<?php echo "{$row['pageTemplate']}?id={$row['eventID']}" ; ?>"> Click here</a></p>
    <?php if($row['statusCode'] == "PAYMENT" && isset($row['eventFeeID'])) : ?>
        <label for="amount">Amount Due: <?php echo $amountDue ?>$</label>
        <?php if(!empty($eventManagerID) && !empty($user->checkIfDebitDetailsExist($eventManagerID))) : ?>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <button type="submit" name="paying" value="<?php echo $row['eventID'] ?>"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png" alt="Check out with PayPal" ></button>
            </form>
        <?php else : ?>
            <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal"
                data-target="#paymentDetailsModal">Checkout</button>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<hr>
<?php endforeach; ?>
<!-- <form name="_xclick" target="event-page.php" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png" alt="Check out with PayPal" >
</form> -->

<!-- <script type="text/javascript">
    function clicked()
    {
        window.open("https://www.paypal.com/cgi-bin/webscr", '_blank');
    }
</script> -->
