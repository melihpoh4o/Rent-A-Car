<?php

session_start();

require 'includes/db.php';
require 'includes/functions.php';

$conn = getDB();
check_login($conn);

$medewerker = check_login_medewerker($conn);
$klant = check_login_klant($conn);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Rent-A-Car</title>
        <link rel="stylesheet" href="css/css.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>
<body>

<?php if ($klant || $medewerker): ?>
    <!-- navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg container-fluid p-4" style="background-color: #0E294B; ">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav" >
            <!--navbar left-->
            <ul class="navbar-nav menu-link ">
                <li class="nav-item ">
                    <a class="nav-link "  href="index.php">HOME</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#">AUTO HUREN</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="#">CONTACT</a>
                </li>
            </ul>


            <!--navbar right-->
            <div class="navbar-collapse" id="navbarNavDarkDropdown ">
                <ul class="navbar-nav ml-auto ms-auto   ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle " viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu " style="right: 0; left: auto">
                            <li><a class="dropdown-item" href="Accountinstellingen.php">Accountinstellingen</a></li>
                            <li><a class="dropdown-item" href="login/logout.php">Uitloggen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>


    </nav>

<?php else: ?>

<?php require 'includes/static_navbar.php'?>

<?php endif;  ?>


<?php if ($klant): ?>

<?php require 'klant/klant_gegevens.php'?>


<?php elseif ($medewerker): ?>

<?php require 'medewerker/medewerker_gegevens.php' ?>

<?php endif; ?>


<script src="js/functions.js"></script>


<?php
require 'includes/footer.php';
?>
