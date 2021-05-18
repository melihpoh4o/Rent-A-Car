<?php

$db_host = "localhost";
$db_name = "rent-a-car";
$db_user = "rent-a-car-user";
$db_pass = "melih123";

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}