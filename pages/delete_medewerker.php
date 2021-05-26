<?php
require '../functions/db.php';

$get_id = $_GET['edit'];
$conn = getDB();

$query = "DELETE FROM factuur WHERE id_medewerker = '$get_id'";
$query_delete = "DELETE FROM medewerker WHERE id_medewerker = '$get_id'";


if (mysqli_query($conn, $query)){
    mysqli_query($conn,$query_delete);
    header("Location: ../pages/instellingen.php");
} else {
    echo "Error record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>