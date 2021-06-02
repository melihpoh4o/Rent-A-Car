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
                                <li><a class="dropdown-item" href="../pages/factuur.php">Factuur</a></li>
                                <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
                            <?php elseif ($medewerker && $medewerker['id_medewerker'] != 1):?>
                                <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
                                <li><a class="dropdown-item" href="../pages/reservering_medewerker.php">Reserveringen</a></li>
                                <li><a class="dropdown-item" href="../pages/voertuigen.php">Voertuigen</a></li>
                                <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
                            <?php elseif ($medewerker['id_medewerker'] == 1): ?>
                                <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
                                <li><a class="dropdown-item" href="../pages/instellingen.php">Instellingen</a></li>
                                <li><a class="dropdown-item" href="../pages/reservering_medewerker.php">Reserveringen</a></li>
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
        $last_id = $_SESSION['id_factuur'];

        $query_select_factuur = "SELECT * FROM auto_model
                                 JOIN auto ON auto.id_auto_model = auto_model.id_auto_model
                                 JOIN reservering ON auto.id_auto = reservering.id_auto
                                 JOIN factuur ON reservering.id_factuur = factuur.id_factuur
                                 JOIN klant ON klant.id_klant = factuur.id_klant
                                 WHERE factuur.id_factuur = '$last_id'";
        $result_select_factuur = mysqli_query($conn,$query_select_factuur);
        $data = mysqli_fetch_assoc($result_select_factuur);

        $query_select_bedrag = "SELECT 
                                ROUND(SUM(datediff(reserveringe_eind_datum + 1, reservering_start_datum) * auto_model_prijs_per_dag  * 0.21), 2) AS btw,
                                ROUND(SUM(datediff(reserveringe_eind_datum + 1, reservering_start_datum) * auto_model_prijs_per_dag  * 1.21), 2) AS Totaal
                                FROM reservering 
                                JOIN auto ON
                                reservering.id_auto = auto.id_auto
                                JOIN auto_model ON auto_model.id_auto_model = auto.id_auto_model";
        $results_select_bedrag = mysqli_query($conn, $query_select_bedrag);
        $data_select_bedrag = mysqli_fetch_assoc($results_select_bedrag);

        $query_select_reservering = "SELECT
                                        auto.auto_kenteken,
                                        auto_model.auto_model_merk,
                                        auto_model.auto_model_model,
                                        reservering.reservering_start_datum,
                                        reservering.reserveringe_eind_datum,
                                        auto_model.auto_model_prijs_per_dag,
                                        datediff(reserveringe_eind_datum + 1, reservering_start_datum) * auto_model_prijs_per_dag as total
                                        FROM reservering 
                                        JOIN auto ON
                                        reservering.id_auto = auto.id_auto
                                        JOIN auto_model ON auto_model.id_auto_model = auto.id_auto_model
                                        WHERE id_factuur = '$last_id'";
        $results_select_reservering = mysqli_query($conn, $query_select_reservering);

        if ($result_select_factuur && mysqli_num_rows($result_select_factuur) > 0) {
            ?>
                <div class="row">
                    <h4 class="m-1">Factuur</h4>
                    <div class="card m-3" style="width: 25rem; height: auto">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Rent-a-Car</li>
                            <li class="list-group-item">Autopad 12</li>
                            <li class="list-group-item">1335 YY ALMERE</li>
                            <li class="list-group-item">Telefoon: (036) 123 45 67</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card m-3" style="width: 25rem; height: auto">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Datum: <?php echo $data['factuur_datum']; ?></li>
                            <li class="list-group-item">Factuurnummer: <?php echo $data['id_factuur']; ?></li>
                            <li class="list-group-item">Behandelaar:<?php echo $data['id_medewerker']; ?></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="card m-3" style="width: 25rem; height: auto">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php echo $data['klant_voornaam']. " " . $data['klant_tussenvoegsel'] . " " .$data['klant_achternaam']; ?></li>
                            <li class="list-group-item"><?php echo $data['klant_straat'] . " " . $data['klant_huisnummer'] ; ?></li>
                            <li class="list-group-item"><?php echo $data['klant_postcode'] . " " . $data['klant_plaats'] ; ?></li>
                        </ul>
                    </div>
                </div>
            <?php

            echo "<h5 class='m-1 mb-3'>Reserveringen</h5><table class='table table-hover table-sm'><thead><tr><th scope='col'>Kenteken</th><th scope='col'>Merk</th>
                   <th scope='col'>Model</th><th scope='col'>Datum</th>
                   <th scope='col'>Prijs per dag</th><th scope='col'>Totaal</th></tr></thead>";
            while ($data = mysqli_fetch_assoc($results_select_reservering)) {
                echo "<tr>
                                
                                <td>
                                    " . $data['auto_kenteken'] . "
                                </td>
                                                        
                                <td >
                                    " . $data["auto_model_merk"] . "
                                </td>
                                                        
                                <td >
                                    " . $data["auto_model_model"] . "
                                </td>
                            
                                <td s>
                                    " . $data["reservering_start_datum"] . "/" . $data["reserveringe_eind_datum"] . "
                                </td>
                                                        
                                <td  >
                                    " . "€ " . $data["auto_model_prijs_per_dag"] . "
                                </td>
                                
        
                                <td >
                                    " . "€ " . $data["total"] . "
                                </td>
        
        
                             </tr>";
            }
            echo "<tr class='col'>
                   <td></td><td></td><td></td><td></td><td >Btw</td><td >€ " . $data_select_bedrag['btw'] . "</td>
                  </tr><tr class='col'>
                   <td></td><td></td><td></td><td></td><td>Totaal te betalen</td><td>€ " . $data_select_bedrag['Totaal'] . "</td>
                  </tr>";

            echo "</table>";

            echo "<div class='col-md-12'>
                    <p>Betalingen dienen plaats te vinden veertien dagen voor de aanvang van de gereserveerde periode
                        op rekeningnummer 3210808 ten name van het Rent-a-Car te Almere. Indien er gereserveerd is
                        binnen veertien dagen voor de aanvang van de gereserveerde periode, dient de betaling direct plaats
                        te vinden.
                    </p>
           </div>";

        }
    ?>




</div>

<!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>
