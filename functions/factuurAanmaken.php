<?php

function factuurAanmaken($conn){

    $id_klant = $_SESSION['id_klant'];
    $sql = "INSERT INTO factuur(id_klant,factuur_datum,factuur_status)
            VALUES ('$id_klant',now(),'0')";
    $result = mysqli_query($conn,$sql);

    $last_id = mysqli_insert_id($conn);
    $_SESSION['id_factuur'] = $last_id;
}
