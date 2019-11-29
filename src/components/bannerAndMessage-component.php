<div class="jumbotron">
    <h1 class="display-4">Main Page placeholder</h1>
    <hr class="my-4">
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <textarea name="message_content" class="message_content" placeholder="..."></textarea>
        <p class="lead">
            <button type="submit" name="submitEventPost" class="btn btn-lg bg-dark text-white">Submit post</button>
        </p>
    </form>
</div>
