<?php
session_start();

if (isset($_SESSION['id_klant'])){
    unset($_SESSION['id_klant']);
}

header("Location: login.php");