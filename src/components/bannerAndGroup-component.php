<div class="jumbotron">
    <h1 class="display-4">View of groups</h1>
    <hr class="my-4">
    <p class="lead">
        <button type="button" class="btn btn-lg bg-dark text-white" data-toggle="modal"
            data-target="#createGroupModal">Create Group</button>
        <button type="button" class="btn btn-lg bg-dark text-white" data-toggle="modal"
            data-target="#joinGroupModal" style="float: right;">Join Group</button>
    </p>
</div>

<?php
    //MODAL FOR CREATING GROUP
    include $_SERVER['DOCUMENT_ROOT'] . 'https://rrc353.encs.concordia.ca/comp353/src/shared/createGroupModal.php';

    //MODAL FOR JOINING GROUP
    include $_SERVER['DOCUMENT_ROOT'] . 'https://rrc353.encs.concordia.ca/comp353/src/shared/joinGroupModal.php';
?>
