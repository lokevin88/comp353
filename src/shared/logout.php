<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/comp353/src/shared/head.php';

    session_start();
    session_unset();
    session_destroy();

    navigateTo("/comp353/index.php");
?>
