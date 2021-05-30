<?php
session_start();

require '../functions/db.php';
$conn = getDB();

$klant_id = $_SESSION['id_klant'];
$start_datum = $_GET['start_datum'];
$eind_datum = $_GET['eind_datum'];
$auto_id  = $_GET['id_auto'];

if ($klant_id == $_SESSION['id_klant']){
    $query_insert = "INSERT INTO reservering (id_auto,id_klant,reservering_betaald,reservering_start_datum,reserveringe_eind_datum)
                 VALUES ('$auto_id','$klant_id','0','$start_datum','$eind_datum')";

    mysqli_query($conn,$query_insert);
    header("Location: ../voertuig_huren.php");
}


