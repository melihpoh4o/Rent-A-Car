<?php
//start session
session_start();

//require functions
require '../functions/getDB.php';
require '../functions/deleteFactuur.php';


//check if button is submitted
if (isset($_SESSION['id_klant'])){
    $conn = getDB();
    //call function to delete factuur if it's empty
    deleteFactuur($conn);
    //log out
    unset($_SESSION['id_klant']);
}

//log out medewerker
else if (isset($_SESSION['id_medewerker'])){
    unset($_SESSION['id_medewerker']);
}

//redirect to index
header("Location: ../index.php");

//die
die();