<?php
//session start
session_start();


//require functions
require '../functions/getDB.php';
require '../functions/factuurAanmaken.php';

//call functions
$conn = getDB();

//get session variable
$klant_id = $_SESSION['id_klant'];

//get $_GET variables
$id_auto_model = $_GET['id_auto_model'];
$start_datum = $_GET['start_datum'];
$eind_datum = $_GET['eind_datum'];

if ($klant_id === $_SESSION['id_klant']){
    //sql to determine id auto
    $sql = "SELECT * 
            FROM auto
            JOIN auto_model 
            ON auto.id_auto_model = auto_model.id_auto_model
            WHERE auto_model.id_auto_model = '$id_auto_model'";
    $results_auto = mysqli_query($conn,$sql);
    $data_auto = mysqli_fetch_assoc($results_auto);
    //pass id_auto to variable
    $id_auto = $data_auto['id_auto'];

    //pass id_factuur to variable
    $last_id = $_SESSION['id_factuur'];

    //query to insert reservering
    $query_insert = "INSERT INTO reservering (id_auto,reservering_betaald,
                        reservering_start_datum,reserveringe_eind_datum,id_factuur)
                     VALUES ('$id_auto','0','$start_datum','$eind_datum','$last_id')";

    //run query
    mysqli_query($conn,$query_insert);

    //update factuur status
    $query_update = "UPDATE factuur SET factuur_status = 1";
    $result_update = mysqli_query($conn,$query_update);

    //redirect to index
    header("Location: ../reserveer.php");
}


