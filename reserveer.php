<?php

//session start
session_start();

//require functions
require 'functions/getDB.php';
require 'functions/checkIfLoggedIn.php';
require 'functions/checkNavGebruiker.php';
require 'functions/zoekVoorVoertuig.php';

//call functions
$conn = getDB();
checkIfLoggedIn($conn);

//set variables tp check if medewerker or klant is logged in
$medewerker = checkLoginMedewerker($conn);
$klant = checkLoginKlant($conn);



?>

    <!-- Voeg html header toe -->
<?php require 'includes/header.php'?>

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
                    <a class="nav-link "  href="index.php">HOME</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="reserveer.php">RESERVEER</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="contact.php">CONTACT</a>
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
                            <!--check if klant is logged in-->
                            <li><a class="dropdown-item" href="pages/account.php">Account</a></li>
                            <?php if ($klant)
                                echo "<li><a class='dropdown-item' href='./pages/factuur.php'>Factuur</a></li>";
                            ?>
                            <!--call function nav-->
                            <?php if ($medewerker) checkNavGebruiker($conn) ?>
                            <li><a class="dropdown-item" href="pages/logout.php">Uitloggen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

<?php else : ?>
    <!-- Guest navbar -->
    <?php require 'includes/guest_navbar.php'?>

<?php endif; ?>


    <!--  Content van de pagina -->
    <div class="container-fluid mt-3">
            <form method="post" class="mb-3 mt-3  ">
                <div class="form-group d-flex justify-content-center">
                    <div class="col-6">
                        <select name="voertuigen" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                            <option name="1" value="1">ZOEK VOOR PERSONEAUTO</option>
                            <option name="2" value="2">ZOEK VOOR BESTELWAGEN</option>
                        </select>
                        <input class="form-control mb-3 " type="date" value="<?php echo date("Y-m-d") ?>" name="start_datum_voertuig">
                        <input class="form-control mb-3 " type="date" value="<?php echo date("Y-m-d")?>" name="eind_datum_voertuig">
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" name="voeg_auto_toe" class="btn btn-primary bg-light text-dark m-3  ">ZOEK VOERTUIG</button>
                </div>
            </form>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 m-4 ">
        <?php
        //check if klant is logged in
        if ($klant){
            //call function
            zoekVoorVoertuig($conn);
        }

        //check if klant is not logged in
        if (!$klant){
            ?>
            <div class="col-md-12 shadow-lg alert alert-muted text-center" role="alert">
                <h5>Log in om een reservering te plaatsen</h5>
            </div>
            <?php
        }

        ?>
    </div>

    <!-- Voeg footer toe -->
<?php require 'includes/footer.php' ?>