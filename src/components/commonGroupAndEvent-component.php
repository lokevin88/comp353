<div class="commonGroupAndEventSide">
    <div class="row">
        <div class="col-lg-12">
            <h2>Three recent requests</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="commonGroupAndEventSideContainer">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . 'https://rrc353.encs.concordia.ca/comp353/src/shared/managedEventStatus.php';
            ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="commonGroupAndEventSideContainer">
                <h4>Events Status</h4>
                <?php if($count_status_events == 0): ?>
                <p>No events status</p>
                <?php endif; ?>

                <?php
                    foreach($user_status_events as $row):
                ?>
                <p>Event name: <?php echo $row['eventName']; ?></p>
                <p>Status: <?php echo $row['statusCode']; ?></p>
                <hr>
                <?php endforeach; ?>

                <div class="btn-group groupAndEventGroup">
                    <button type="button" class="btn bg-dark text-white" data-toggle="modal"
                        data-target="#createEventModal">Create Event</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include $_SERVER['DOCUMENT_ROOT'] . 'https://rrc353.encs.concordia.ca/comp353/src/shared/createEventModal.php';
    include $_SERVER['DOCUMENT_ROOT'] . 'https://rrc353.encs.concordia.ca/comp353/src/shared/createGroupModal.php';
?>
