<?php
session_start();

require '../functions/db.php';
require '../functions/factuurAanmaken.php';
$conn = getDB();

$klant_id = $_SESSION['id_klant'];
$start_datum = $_GET['start_datum'];
$eind_datum = $_GET['eind_datum'];
$auto_id  = $_GET['id_auto'];

if ($klant_id == $_SESSION['id_klant']){
    $last_id = $_SESSION['id_factuur'];

    $query_insert = "INSERT INTO reservering (id_auto,reservering_betaald,
                        reservering_start_datum,reserveringe_eind_datum,id_factuur)
                     VALUES ('$auto_id','0','$start_datum','$eind_datum','$last_id')";

    mysqli_query($conn,$query_insert);

    $query_update = "UPDATE factuur SET factuur_status = 1";
    $result_update = mysqli_query($conn,$query_update);

    header("Location: ../voertuig_huren.php");
}


