<?php
    require $_SERVER['DOCUMENT_ROOT'] . 'https://rrc353.encs.concordia.ca/comp353/src/shared/head.php';

    session_start();
    session_unset();
    session_destroy();

    navigateTo("https://rrc353.encs.concordia.ca/comp353/index.php");
?>
