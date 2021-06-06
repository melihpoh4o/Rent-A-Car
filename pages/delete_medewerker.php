<?php
//require
require '../functions/getDB.php';

//get reservering id
$get_id = $_GET['edit'];

//call functions
$conn = getDB();

//query delete factuur
$query = "DELETE FROM factuur WHERE id_medewerker = '$get_id'";

//query delete medewerker
$query_delete = "DELETE FROM medewerker WHERE id_medewerker = '$get_id'";


//run query
mysqli_query($conn, $query);
mysqli_query($conn,$query_delete);

//redirect to another page
header("Location: ../pages/instellingen.php");


mysqli_close($conn);
?>