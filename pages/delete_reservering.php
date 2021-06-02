<?php
session_start();

require '../functions/db.php';
$conn = getDB();

$reservering_id  = $_GET['delete'];

$sql = "DELETE FROM reservering
        WHERE id_reservering = $reservering_id";
$sql_delete = "UPDATE auto
               SET auto_status_reservering = 0";
mysqli_query($conn,$sql);
mysqli_query($conn,$sql_delete);
header("Location: factuur.php");