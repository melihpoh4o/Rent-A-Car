<?php
session_start();

//require functions
require '../functions/db.php';
require '../functions/check_if_logged_in.php';
require '../functions/check_gebruiker_nav.php';
require '../functions/admin_gebruiker_check.php';
require '../functions/zoek_voertuig.php';

//call functions
$conn = getDB();
check_if_logged_in($conn);

//set variables tp check if medewerker or klant is logged in
$medewerker = check_login_medewerker($conn);
$klant = check_login_klant($conn);

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
                                <li><a class="dropdown-item" href="../pages/mijn_reserveringen.php">Reserveringen</a></li>
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
    <?php
    $klant_id = $_SESSION['id_klant'];
    $query = "SELECT * 
                FROM auto
                JOIN auto_model 
                ON auto.id_auto_model = auto_model.id_auto_model
                JOIN reservering ON reservering.id_auto = auto.id_auto
                WHERE reservering.id_klant = $klant_id
                  ";
    $results = mysqli_query($conn,$query);

    ?>
    <?php
    echo "<table class='table table-striped'><tr><th class='col'>Klant Naam</th><th scope='col'>Kenteken</th>
                 <th scope='col'>Voertuig</th><th scope='col'>Bouwjaar</th><th scope='col'>Datum</th>
                    <th>Prijs per dag</th></tr>";
    while ($data = mysqli_fetch_assoc($results)) {
        echo "<tr>
                        <td style='word-break:break-all;'>
                            " . $klant['klant_voornaam'] . " " . $klant['klant_achternaam'] . "
                        </td>
                                                
                        <td style='word-break:break-all;'>
                            " . $data["auto_kenteken"] . "
                        </td>
                                                
                        <td style='word-break:break-all;'>
                            " . $data["auto_model_merk"] . " " . $data["auto_model_model"] . "
                        </td>
                                                
                        <td style='word-break:break-all;'>
                             " . $data["auto_model_bouwjaar"] . "
                        </td>
                                                
                        <td style='word-break:break-all;'>
                            " . $data["reservering_start_datum"] . "/" . $data["reserveringe_eind_datum"] . "
                        </td>
                                                
                        <td style='word-break:break-all;'>
                            " . "€" . $data["auto_model_prijs_per_dag"] . "
                        </td>
                            
                     </tr>";
    }
    echo "</table>";
    ?>
</div>

<!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>
