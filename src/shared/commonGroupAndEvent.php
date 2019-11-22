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
            <form action="commonGroupAndEvent.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="createEvent" class="btn bg-dark text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
