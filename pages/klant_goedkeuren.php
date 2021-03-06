<?php
require '../functions/getDB.php';

//get id_model
$get_id = $_GET['edit'];

//db function
$conn = getDB();

//change klant info to medewerker table
$query_insert = "INSERT INTO medewerker 
            (medewerker_voornaam,
            medewerker_tussenvoegsel,
            medewerker_achternaam,
            medewerker_straat,
            medewerker_huisnummer,
            medewerker_postcode,
            medewerker_plaats,
            medewerker_email,
            medewerker_wachtwoord,
            medewerker_tel)
          SELECT
            klant.klant_voornaam,
            klant.klant_tussenvoegsel,
            klant.klant_achternaam,
            klant.klant_straat,
            klant.klant_huisnummer,
            klant.klant_postcode,
            klant.klant_plaats,
            klant.klant_email,
            klant.klant_wachtwoord,
            klant.klant_tel
          FROM klant             
          WHERE id_klant = '$get_id'";

//delete factuur
$query_delete_factuur = "DELETE FROM factuur WHERE id_klant = '$get_id'";
//delete klant
$query_delete_klant = "DELETE FROM klant WHERE id_klant = '$get_id'";

//call mysqli_query
mysqli_query($conn, $query_insert);
mysqli_query($conn,$query_delete_factuur);
mysqli_query($conn,$query_delete_klant);

//redirect
header("Location: ../pages/instellingen.php")

?>
