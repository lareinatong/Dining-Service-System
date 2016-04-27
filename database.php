<?php
    $mysqli = new mysqli('localhost', 'USERNAME', 'PASSWORD', 'duc');
         
    if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
    }
?>