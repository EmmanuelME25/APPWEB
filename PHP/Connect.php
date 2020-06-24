<?php
    $host = "localhost";
        $usDb = "root";
        $passDb = "";
        $dbName = "CLASSMATEBOOKING";
            
        $conn = new mysqli($host, $usDb, $passDb, $dbName);
        mysqli_set_charset($conn, "utf8");

        if(mysqli_connect_error()){
            die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
?>
