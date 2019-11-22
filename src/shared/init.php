<?php
    function navigateTo($url) {
        header("Location: " . $url);
        exit();
    }
?>
