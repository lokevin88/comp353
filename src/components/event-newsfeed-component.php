<div id="newsfeed">


    <?php if($count_all_member_posting == 0): ?>
    <div class="card">
        <div class="card-body">
            Be the first to post something in this event
        </div>
    </div>
    <?php endif; ?>

    <?php
        foreach($event_all_member_posting as $row):
        $event_all_replies_on_member_posting = $event->getAllRepliesFromPostsInEvent($eventID, $row['postsID']);
        $count_all_replies_on_member_posting = count($event_all_replies_on_member_posting);
    ?>
    <div class="card">
        <div class="card-header card-title-text">
            Posted on <?php echo $row['timeOfPosting']; ?>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p class="card-body-text"><?php echo $row['content']; ?></p>
                <footer class="blockquote-footer card-name-text"><?php echo $row['userWhoPosted']; ?></footer>
            </blockquote>
        </div>
        <div class="card-footer">
            <div id="reply-<?php echo $row['postsID']; ?>" class="text-reply-color card-body-text">reply (<?php echo $count_all_replies_on_member_posting ?>)</div>
                <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/event-newsfeed-reply-component.php';
                ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
