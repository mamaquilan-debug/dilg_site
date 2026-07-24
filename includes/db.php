<?php
/**
 * db.php
 * Database connection for DILG Davao de Oro website
 */

$host = "localhost";
$user = "root";
$pass = "";
$db   = "dilg_davaodeoro";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database Connection Failed");
}
