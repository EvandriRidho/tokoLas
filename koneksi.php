<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "karya_putra_collections";
    $con = mysqli_connect($servername, $username, $password, $dbname);

    // check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>