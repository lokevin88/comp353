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
                include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/managedEventStatus.php';
            ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="commonGroupAndEventSideContainer">
                <h4>Events Status</h4>
                <p>placeholder1EventName</p>
                <p>placeholder2EventName</p>
                <p>placeholder3GroupName</p>
                <div class="btn-group groupAndEventGroup">
                    <button type="button" class="btn bg-dark text-white">View More</button>
                    <button type="button" class="btn bg-dark text-white" data-toggle="modal"
                        data-target="#createEventModal">Create Event</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="commonGroupAndEventSideContainer">
                <h4>Groups Status</h4>
                <p>placeholder1GroupName</p>
                <p>placeholder2GroupName</p>
                <p>placeholder3GroupName</p>
                <div class="btn-group groupAndEventGroup">
                    <button type="button" class="btn bg-dark text-white">View More</button>
                    <button type="button" class="btn bg-dark text-white">Create Group</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/createEventModal.php';
?>
