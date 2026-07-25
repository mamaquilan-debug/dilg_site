<?php
$host = "localhost";
$user = "region11_dilg_davaodeoro";      // the MySQL user you created
$pass = "6b980add-2f82-4a7b-995d-031fdf867b51";     // that user's password
$db   = "region11_dilg_davaodeoro";         // the database name you created

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database Connection Failed");
}