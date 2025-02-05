<?php

$server = "localhost:3306";
$username = "root";
$password = "";
$db_name = "flexmoney_yoga";

$con = mysqli_connect($server, $username, $password, $db_name);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$con) {
    die(mysqli_connect_error());
}
