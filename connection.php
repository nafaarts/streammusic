<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "db_streammusic";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    print("Connection Failed ");
    die;
}
