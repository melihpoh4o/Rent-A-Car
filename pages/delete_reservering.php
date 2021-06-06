<?php
//start session
session_start();

//require functions
require '../functions/getDB.php';

//call functions
$conn = getDB();

//get reservering id
$reservering_id  = $_GET['delete'];

//query delete reservering
$sql = "DELETE FROM reservering
        WHERE id_reservering = $reservering_id";

//update status auto
$sql_delete = "UPDATE auto
               SET auto_status_reservering = 0";

//run query
mysqli_query($conn,$sql);
mysqli_query($conn,$sql_delete);

//redirect to another page
header("Location: factuur.php");