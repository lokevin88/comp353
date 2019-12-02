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
        $group_all_replies_on_member_posting = $group->getAllRepliesFromPostsInGroup($groupID, $row['gPostsID']);
        $count_all_replies_on_member_posting = count($group_all_replies_on_member_posting);

        if(isset($_POST["submitGroupReplyPost-{$row['gPostsID']}"])) {
            $postsID = $row['gPostsID'];
            $body_content = $_POST['replyContent'];

            $user->submitRepliesToGroupPosts($postsID, $body_content);
            $path = "<script>window.location = '/comp353/src/pages/group-details-page.php?groupID=$groupID';</script>";
            echo $path;
            exit;
        }
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
            <div id="reply-<?php echo $row['gPostsID']; ?>" class="text-reply-color card-body-text" onclick="displayReplies(event);">reply (<?php echo $count_all_replies_on_member_posting ?>)</div>
                <?php
                    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/components/group-newsfeed-reply-component.php';
                ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
