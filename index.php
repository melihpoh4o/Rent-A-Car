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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <title>Rent-A-Car</title>
    </head>
<body>

<?php if ($klant || $medewerker): ?>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark container-fluid p-4" style="background-color: #0E294B">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav" >
        <ul class="navbar-nav menu-link">
            <li class="nav-item ">
                <a class="nav-link"  href="index.php">HOME</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">AUTO HUREN</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">CONTACT</a>
            </li>

        </ul>

        <ul class='navbar-nav ml-auto ms-auto'>
            <li class='nav-item'>
                <a class='nav-link' href='login/logout.php'> UITLOGGEN </a>
            </li>
        </ul>

    </div>
</nav>

<?php else: ?>

<?php require 'includes/static_navbar.php'?>

<?php endif;  ?>


<div class="container-fluid p-4 mb-5 ">
    <div class="row">


        <?php echo "Hello " . $klant['klant_voornaam']  ?>

        <?php echo "Hello " . $medewerker['medewerker_voornaam']  ?>

        <h2 class="text-center">INFO BEDRIJF</h2>

    </div>

    <div class="row">

        <div class="col-md-4">
            <img class="img-fluid" src="https://source.unsplash.com/random/600x400?sig=1" alt="" />

        </div>

        <div class="col-md-4">
            <img class="img-fluid" src="https://source.unsplash.com/random/600x400?sig=2" alt="" />

        </div>

        <div class="col-md-4">
            <img class="img-fluid" src="https://source.unsplash.com/random/600x400?sig=3" alt="" />

        </div>

    </div>

</div>
</body>

<?php
    require 'includes/footer.php';
?>