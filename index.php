<?php

//start session
session_start();

//require functions
require 'functions/getDB.php';
require 'functions/checkIfLoggedIn.php';
require 'functions/checkNavGebruiker.php';
require 'functions/showVehicles.php';

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
                        <li><a class="dropdown-item" href="pages/account.php">Account</a></li>
                        <!--check if klant is logged in-->
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
    <div class="container-fluid">
        <div class="row align-items-start g-4 m-2">
            <h3>Rent-a-Car</h3>
            <div class="col-sm col-sm-8">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolor,
                    doloribus id impedit in labore magni natus odio pariatur perspiciatis qui quia quo vel voluptate voluptatem!
                    Fuga libero omnis tempora.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab at deserunt, eaque earum fugiat, incidunt ipsam nisi nostrum quam quibusdam soluta tenetur.
                    Asperiores commodi dignissimos eligendi excepturi nobis odit reprehenderit?
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, culpa debitis distinctio enim in incidunt inventore ipsum
                    libero non nulla officiis porro quas quasi quia quibusdam quidem, repudiandae ullam ut.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque aut eius explicabo ipsa magni nemo omnis, quaerat quam quisquam vitae!
                    Eius eveniet inventore qui repellendus. Consequatur ipsam laborum quo sint.
                </p>
            </div>
            <div class="col-sm col-sm-4">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Telefoon: (036) 123 45 67</li>
                        <li class="list-group-item">Adres: Autopad 12 1335 YY ALMERE</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 m-2 ">
            <!--call function-->
            <?php showVehicles($conn); ?>
        </div>
    </div>


<!-- Voeg footer toe -->
<?php require 'includes/footer.php' ?>