<?php
session_start();

//require functions
require '../functions/db.php';
require '../functions/check_if_logged_in.php';
require '../functions/check_gebruiker_nav.php';
require '../functions/admin_gebruiker_check.php';

//call functions
$conn = getDB();
check_if_logged_in($conn);

//set variables tp check if medewerker or klant is logged in
$medewerker = check_login_medewerker($conn);
$klant = check_login_klant($conn);
?>

<!-- Voeg html header toe -->
<?php require '../includes/header.php'?>

<?php if ($medewerker['id_medewerker'] == 1): ?>
    <!--Logged in navbar-->
    <nav class="navbar navbar-dark  navbar-expand-lg container-fluid p-4" style="background-color: #0E294B; ">

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
                    <a class="nav-link " href="../voertuig_huren.php">AUTO HUREN</a>
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
                            <?php if ($klant):?>
                                <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
                                <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
                            <?php elseif ($medewerker && $medewerker['id_medewerker'] != 1):?>
                                <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
                                <li><a class="dropdown-item" href="../pages/voertuigen.php">Voertuigen</a></li>
                                <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
                            <?php elseif ($medewerker['id_medewerker'] == 1): ?>
                                <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
                                <li><a class="dropdown-item" href="../pages/instellingen.php">Instellingen</a></li>
                                <li><a class="dropdown-item" href="../pages/voertuigen.php">Voertuigen</a></li>
                                <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
                            <?php endif; ?>
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

        <?php if ($_SESSION['id_medewerker'] == 1) : ?>

            <div class="row">

                <div class="d-flex justify-content-center mb-3 mt-3  ">
                    <form method="post" class="mb-3 mt-3  ">
                        <select name="gebruikers" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                            <option name="1" value="1" selected>ZOEK VOOR KLANT EN MEDEWERKER</option>
                            <option name="2" value="2">KLANT</option>
                            <option name="3" value="3">MEDEWERKER</option>
                        </select>

                        <button type="submit" name="button_gebruiker" class="btn bg-success text-white ">VERSTUUR</button>
                    </form>
                </div>

                <div class="col-md-12">
                    <?php admin_gebruiker_check($conn); ?>
                </div>

            </div>

        <?php endif; ?>

    </div>

<!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>
