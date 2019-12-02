<div class="jumbotron">
    <?php echo $title?>
    <hr class="my-4">
    <p class="lead">
        <div style="text-align: right">
            <form action='group-details-page.php' method="post">
                <button type="submit" class="btn btn-danger" value="<?php echo $groupID; ?>" name="deleteGroup">
                    Delete Group <i class="fa fa-minus-circle"></i>
                </button>
            </form>
        </div>
    </p>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <textarea name="message_content" class="message_content" placeholder="..."></textarea>
        <p class="lead">
            <button type="submit" name="submitGroupPost" class="btn btn-lg bg-dark text-white">Submit post</button>
        </p>
    </form>
</div>
