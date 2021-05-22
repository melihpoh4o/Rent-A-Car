<?php
session_start();

if (isset($_SESSION['id_klant'])){
    unset($_SESSION['id_klant']);
}
else if (isset($_SESSION['id_medewerker'])){
    unset($_SESSION['id_medewerker']);
}

header("Location: ../index.php");

die();