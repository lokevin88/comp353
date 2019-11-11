<?php

    DEFINE ('dbUser', '');
    DEFINE ('dbPassword', '');
    DEFINED ('dbhost', '');

    $databaseConnection = mysqli_connect(dbHost, dbUser, dbPassword);

    if(!$databaseConnection) {
        echo 'Could not connect to the server';
        exit;
    }
?>