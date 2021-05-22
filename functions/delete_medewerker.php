<?php
require '../includes/db.php';

$get_id = $_GET['edit'];
$conn = getDB();

$query = "DELETE FROM medewerker WHERE id_medewerker = '$get_id'";

if (mysqli_query($conn, $query)){
    header("Location: ../instellingen.php");
    die();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>