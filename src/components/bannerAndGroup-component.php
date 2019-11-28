<div class="jumbotron">
    <h1 class="display-4">Main Page placeholder</h1>
    <hr class="my-4">
    <p class="lead">
        <button type="button" class="btn btn-lg bg-dark text-white" data-toggle="modal"
            data-target="#createGroupModal">Create Group</button>
        <button type="button" class="btn btn-lg bg-dark text-white" data-toggle="modal"
            data-target="#joinGroupModal" style="float: right;">Join Group</button>
    </p>
</div>

<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/createGroupModal.php';

    //// CREATE MODAL FOR JOINING GROUP
    include $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/joinGroupModal.php';
?>
