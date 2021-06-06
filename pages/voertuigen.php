<?php

//start session
session_start();

//require functions
require '../functions/getDB.php';
require '../functions/checkIfLoggedIn.php';
require '../functions/checkNavGebruiker.php';
require '../functions/adminCheckGebruiker.php';
require '../functions/zoekVoertuig.php';
require '../functions/navigatieGebruiker.php';

//call functions
$conn = getDB();
checkIfLoggedIn($conn);

//set variables tp check if medewerker or klant is logged in
$medewerker = checkLoginMedewerker($conn);
$klant = checkLoginKlant($conn);

?>

<!-- Voeg html header toe -->
<?php require '../includes/header.php'?>

<?php if ($klant || $medewerker): ?>
    <!--Logged in navbar-->
    <nav class="shadow-lg rounded navbar navbar-expand-lg navbar-light bg-light container-fluid p-4 text-color">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav" >
            <!--navbar left-->
            <ul class="navbar-nav menu-link ">
                <li class="nav-item ">
                    <a class="nav-link "  href="../index.php">HOME</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="../reserveer.php">RESERVEER</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="../contact.php">CONTACT</a>
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
                            <?php navigatieGebruiker($conn) ?>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

<?php else : ?>
    <!-- Guest navbar -->
    <?php require '../includes/guest_navbar.php'?>

<?php endif; ?>

<div class="container-fluid p-4 mb-5 ">
    <div class="row">

        <div>
            <form method="post" class="mb-3 mt-3 d-flex justify-content-center  ">

                <button type="submit" name="zoek_voertuigen" class="btn btn-primary bg-light text-dark m-3">ZOEK VOERTUIGEN</button>
                <a href="voertuig_toevoegen.php" class="btn btn-primary bg-light text-dark m-3">NIEUWE VOERTUIG TOEVOEGEN</a>
            </form>

        </div>

        <div class="col-md-12">
            <!--call function-->
            <?php zoekVoertuig($conn); ?>
        </div>

    </div>
</div>

<!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>
