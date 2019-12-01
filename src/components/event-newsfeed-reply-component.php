<div class="row mt-3">
    <?php
        foreach($event_all_replies_on_member_posting as $row):
    ?>
    <div class="col-md-12">
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder=" ..." aria-label=" ..."
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">post</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <div class="row">
                        <div class="col-lg-10">
                            <small>testsetset</small>
                        </div>
                        <div class="col-lg-2">
                            <footer class="blockquote-footer card-name-text">
                                <small><mark><?php echo $row['userWhoPosted']; ?></mark></small>
                            </footer>
                        </div>
                    </div>
                </blockquote>
            </div>
            <div class="card-footer bg-dark">
                <div class="text-white"><small>Posted on <?php echo $row['timeOfPosting']; ?></small></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
