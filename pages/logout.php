<?php
session_start();
require '../functions/db.php';
require '../functions/delete_factuur.php';

if (isset($_SESSION['id_klant'])){
    $conn = getDB();
    deleteFactuur($conn);
    unset($_SESSION['id_klant']);
}
else if (isset($_SESSION['id_medewerker'])){
    unset($_SESSION['id_medewerker']);
}

header("Location: ../index.php");

die();