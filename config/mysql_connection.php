<?php
    session_start();

    // DEFINE ('isAdmin', 'admin@db.com');
    DEFINE ('isController', 'controller@db.com');

    DEFINE ('dbUser', 'rrc353_2');
    DEFINE ('dbPassword', 'raG4Ek');
    DEFINE ('dbHost', 'rrc353.encs.concordia.ca');
    DEFINE ('dbName', 'rrc353_2');

    $databaseConnection = mysqli_connect(dbHost, dbUser, dbPassword, dbName);

    if(!$databaseConnection) {
        echo 'Could not connect to the server';
        exit;
    }
?>
