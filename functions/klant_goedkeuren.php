<?php
require '../includes/db.php';

$get_id = $_GET['edit'];
$conn = getDB();

$query = "INSERT INTO medewerker 
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

$query_delete = "DELETE FROM klant WHERE id_klant = '$get_id'";

if (mysqli_query($conn, $query)){
    mysqli_query($conn,$query_delete);
    header("Location: ../instellingen.php");
    die();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
