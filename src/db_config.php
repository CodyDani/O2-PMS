<?php

$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'pms_db';

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if(!$conn) {
    echo "Connection Unsuccessful: " . mysqli_connect_error();
}