<div class="commonGroupAndEventSide">
    <div class="row">
        <div class="col-lg-12">
            <div class="commonGroupAndEventSideContainer">
                <h4>Events</h4>
                <p>placeholder1EventName</p>
                <p>placeholder2EventName</p>
                <p>placeholder3EventName</p>
                <div class="btn-group groupAndEventGroup">
                    <button type="button" class="btn bg-dark text-white">View More</button>
                    <button type="button" class="btn bg-dark text-white" data-toggle="modal"
                        data-target="#createEvent">Create Event</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="commonGroupAndEventSideContainer">
                <h4>Groups</h4>
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


<div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="homepage.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="eventName">Event</label>
                        <input type="text" class="form-control" name="eventName" id="eventName"
                            placeholder="Enter event name" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Description</label>
                        <input type="text" class="form-control" name="eventDescription" id="eventDescription"
                            placeholder="Enter description" required>
                    </div>
                    <div class="form-group">
                        <label for="eventPhoneNumber">Phone number</label>
                        <input type="text" class="form-control" name="eventPhoneNumber" id="eventPhoneNumber"
                            placeholder="Enter phone number" required>
                    </div>
                    <fieldset class="form-group">
                        <p class="col-form-label pt-0">Event type</p>
                        <div class="row text-center">
                            <div class="form-check col-md-6">
                                <input class="form-check-input" type="radio" name="eventType" id="eventType"
                                    value="public" checked required>
                                <label class="form-check-label text-nowrap" for="eventType">
                                    Public
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <input class="form-check-input" type="radio" name="eventType" id="eventType"
                                    value="private" required>
                                <label class="form-check-label text-nowrap" for="eventType">
                                    private
                                </label>
                            </div>

                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="eventSize">Event size</label>
                        <input type="number" class="form-control" name="eventSize" id="eventSize" min="25" value="25">
                    </div>
                    <div class="form-group">
                        <label for="eventStartDate" class="col-sm-2 col-form-label text-nowrap">Start Date</label>
                        <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" name="eventStartDate"
                            id="eventStartDate" required>

                    </div>
                    <div class="form-group">
                        <label for="eventEndDate" class="col-sm-2 col-form-label text-nowrap">End Date</label>
                        <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" name="eventEndDate"
                            id="eventEndDate" required>
                    </div>
                    <fieldset class="form-group">
                        <p class="col-form-label pt-0">Page template</p>
                        <div class="row text-center">
                            <div class="form-check col-md-6">
                                <input class="form-check-input" type="radio" name="pageTemplate" id="pageTemplate"
                                    value="/comp353/src/pages/eventTemplate/event-something-template.php" checked
                                    required>
                                <label class="form-check-label text-nowrap" for="pageTemplate">
                                    Something1Placholder
                                </label>
                            </div>
                            <div class="form-check col-md-6">
                                <input class="form-check-input" type="radio" name="pageTemplate" id="pageTemplate"
                                    value="/comp353/src/pages/eventTemplate/event-something2-template.php" required>
                                <label class="form-check-label text-nowrap" for="pageTemplate">
                                    Something2Placeholder
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="createEvent" class="btn bg-dark text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
