<?php

session_start();

//require functions
require '../functions/db.php';
require '../functions/check_if_logged_in.php';
require '../functions/update_gegevens.php';
require '../functions/check_admin_rol.php';
require '../functions/check_gebruiker_nav.php';

//call functions
$conn = getDB();
check_if_logged_in($conn);
update_gegevens($conn);

//set variables tp check if medewerker or klant is logged in
$medewerker = check_login_medewerker($conn);
$klant = check_login_klant($conn);

?>

    <!-- Voeg html header toe -->
<?php require '../includes/header.php'?>

<?php if ($klant || $medewerker): ?>
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


    <!--  Content van de pagina -->
    <div class="container-fluid">
        <?php if ($klant): ?>

            <div class="container-fluid p-4 mb-5 ">

                <div class="row">

                    <div class="col-md-4">

                        <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

                        <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                            <h3 class="mb-3">GEGEVENS</h3>

                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email"  aria-describedby="emailHelp " value="<?php echo "" .$klant['klant_email']?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <input class="form-control mb-2" type="password" name="wachtwoord" id="myInput"  placeholder="Email" value="<?php echo "" . $klant['klant_wachtwoord']?>" required >
                                <input class="form-check-input"  type="checkbox" onclick="showPassword()">
                            </div>

                            <button type="submit" name="inloggegevens" class="btn mt-3 bg-light">OPSLAAN</button>

                        </form>

                        <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

                    </div>

                    <div class="col-md-4">

                        <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

                        <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                            <h3 class="mb-3">ACCOUNT</h3>

                            <div class="form-group mb-3">
                                <input type="text" name="voornaam" class="form-control" placeholder="Voornaam" value="<?php echo "" . $klant['klant_voornaam']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="tussenvoegsel" class="form-control" id="text" placeholder="Tussenvoegsel" value="<?php echo "" . $klant['klant_tussenvoegsel']?>"  >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="achternaam" class="form-control"  placeholder="Achternaam" value="<?php echo "" . $klant['klant_achternaam']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="straat" class="form-control" id="text" placeholder="Straat" value="<?php echo "" . $klant['klant_straat']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="huisnummer" class="form-control" placeholder="Huisnummer" value="<?php echo "" . $klant['klant_huisnummer']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="postcode" class="form-control" placeholder="Postcode" value="<?php echo "" . $klant['klant_postcode']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="plaats" class="form-control" placeholder="Plaats" value="<?php echo $klant['klant_plaats']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="tel" name="tel" class="form-control" placeholder="Tel" value="<?php echo "" .$klant['klant_tel']?>">
                            </div>

                            <button type="submit" name="mijn_gegevens" class="btn mt-3 bg-light"  >OPSLAAN</button>

                        </form>

                        <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

                    </div>

                    <div class="col-md-4">

                        <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

                        <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                            <h3 class="mb-3">ROL</h3>

                            <div class="form-group ">
                                <input class="form-control mb-2" type="text" placeholder="Klant"  value=" <?php if ($klant) echo "Klant"  ?>" readonly >
                            </div>

                        </form>

                        <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

                    </div>

                </div>

            </div>


        <?php elseif ($medewerker): ?>

            <div class="container-fluid p-4 mb-5 ">

                <div class="row">

                    <div class="col-md-4">

                        <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

                        <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                            <h3 class="mb-3">GEGEVENS</h3>

                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo "" . $medewerker['medewerker_email']?>"  aria-describedby="emailHelp" required>
                            </div>

                            <div class="form-group mb-3">
                                <input class="form-control mb-2" type="password" name="wachtwoord" id="myInput"  placeholder="Wachtwoord" value="<?php echo "" . $medewerker['medewerker_wachtwoord']?>" required >
                                <input class="form-check-input"  type="checkbox" onclick="showPassword()">
                            </div>

                            <button type="submit" name="inloggegevens_medewerker" class="btn mt-3 bg-light">OPSLAAN</button>

                        </form>

                        <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

                    </div>

                    <div class="col-md-4">

                        <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

                        <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                            <h3 class="mb-3">ACCOUNT</h3>

                            <div class="form-group mb-3">
                                <input type="text" name="voornaam" class="form-control" placeholder="Voornaam" value="<?php echo "" . $medewerker['medewerker_voornaam']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="tussenvoegsel" class="form-control" id="text" placeholder="Tussenvoegsels" value="<?php echo "" . $medewerker['medewerker_tussenvoegsel']?>"  >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="achternaam" class="form-control"  placeholder="Achternaam" value="<?php echo "" . $medewerker['medewerker_achternaam']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="straat" class="form-control" id="text" placeholder="Straat" value="<?php echo "" . $medewerker['medewerker_straat']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="huisnummer" class="form-control" placeholder="Huisnummer" value="<?php echo "" . $medewerker['medewerker_huisnummer']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="postcode" class="form-control" placeholder="Postcode" value="<?php echo "" . $medewerker['medewerker_postcode']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="plaats" class="form-control" placeholder="Plaats" value="<?php echo "" . $medewerker['medewerker_plaats']?>" required >
                            </div>

                            <div class="form-group mb-3">
                                <input type="tel" name="tel" class="form-control" placeholder="Tel" value="<?php echo "" . $medewerker['medewerker_tel']?>">
                            </div>

                            <button type="submit" name="mijn_gegevens_medewerker" class="btn mt-3 bg-light">OPSLAAN</button>

                        </form>

                        <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

                    </div>

                    <div class="col-md-4">

                        <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

                        <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                            <h3 class="mb-3">ROL</h3>

                            <div class="form-group mb-3">
                                <input class="form-control" type="text"  placeholder="Rol" value=" <?php check_admin_rol($conn); ?>" readonly>
                            </div>

                        </form>

                        <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

                    </div>

                </div>

            </div>

        <?php endif; ?>
    </div>

<!--call js functions-->
<script src="../js/functions.js"></script>


    <!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>