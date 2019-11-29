<div id="newsfeed">
    <?php if($count_all_member_posting == 0): ?>
    <div class="card">
        <div class="card-body">
            Be the first to post something in this group
        </div>
    </div>
    <?php endif; ?>

    <?php
        foreach($group_all_member_posting as $row):
    ?>
    <div class="card">
        <div class="card-header card-title-text">
            Posted on <?php echo $row['timeOfPosting']; ?>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p class="card-body-text"><?php echo $row['content']; ?></p>
                <footer class="blockquote-footer card-name-text"><?php echo $row['userWhoPosted']; ?></footer>
                <a href="#" class="card-body-text">comment</a>
            </blockquote>
        </div>
    </div>
    <?php endforeach; ?>
</div>
