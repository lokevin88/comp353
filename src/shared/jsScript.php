<script type="text/javascript">
    function navigateTo($url) {
        header("Location: " . $url);
        exit();
    }

    function displayMessage($msg) {
        $('body').prepend('<div class="container-fluid"><div class="row"><div class="col-sm-12 d-flex justify-content-center">' + $msg + '<h3></h3></div></div></div>')
    }
</script>
</body>