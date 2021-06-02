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

<div class="container-fluid p-4 mb-5  ">
    <div class="form-group d-flex justify-content-center ">
        <form method="post">
            <div class="row">
                <div class="col">
                    <input class="form-control" name="datum" type="date" value="<?php echo date("Y-m-d") ?>">
                </div>
                <div class="col">
                    <button type="submit" name="verstuur" class="btn btn-success bg-light text-dark">VERSTUUR</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid p-4 mb-5  ">
<?php
    if (isset($_POST['verstuur'])){

        $time = strtotime($_POST['datum']);

        if ($time) {
            $dag_datum = date('d-m-Y', $time);
            ?>
            <div class="row">
                <div class="col mb-1">
                    <h5>Datum: <?php echo $dag_datum?></h5>
                </div>
            </div>
            <?php

        }

        $time = strtotime($_POST['datum']);
        $dag_datum = date('Y-m-d', $time);
        $sql = "SELECT 
                reservering.id_reservering,
                klant.klant_voornaam,
                klant.klant_achternaam,
                auto.auto_kenteken,
                reservering.reservering_start_datum,
                reservering.reserveringe_eind_datum,
                auto_model.auto_model_prijs_per_dag
                FROM reservering
				JOIN factuur ON factuur.id_factuur = reservering.id_factuur
				JOIN klant ON factuur.id_klant = klant.id_klant
                JOIN auto ON reservering.id_auto = auto.id_auto
                JOIN auto_model ON auto_model.id_auto_model = auto.id_auto_model
                WHERE reservering_start_datum = '$dag_datum'";

        $results = mysqli_query($conn, $sql);

        if ($results && mysqli_num_rows($results) > 0){
            echo "<table class='table table-striped'><tr><th class='col'>Naam klant</th><th scope='col'>Kenteken</th>
                        <th scope='col'>Gereserveerde periode</th><th>Prijs per dag</th><th>Totaal</th></tr>";
            while ($row = mysqli_fetch_assoc($results)) {
                $start_date = strtotime($row["reservering_start_datum"]);
                $start_datum = date('d-m-Y', $start_date);
                $eind_date = strtotime($row["reserveringe_eind_datum"]);
                $eind_datum = date('d-m-Y', $eind_date);
                $id_reservering = $row['id_reservering'];

                $query_total_price = "SELECT
                                      reservering.id_reservering, 
                                      auto.id_auto,
                                      auto_model.auto_model_merk,
                                      auto_model.auto_model_model,
                                      reservering.reservering_start_datum,
                                      reservering.reserveringe_eind_datum,
                                      datediff(reserveringe_eind_datum + 1, reservering_start_datum) * auto_model_prijs_per_dag  as total
                                      FROM reservering 
                                      INNER JOIN auto ON
                                      reservering.id_auto = auto.id_auto
                                      INNER JOIN auto_model ON auto_model.id_auto_model = auto.id_auto_model
                                      WHERE reservering.id_reservering = '$id_reservering'";
                $results_total_price = mysqli_query($conn, $query_total_price);
                while ($data = mysqli_fetch_assoc($results_total_price)) {

                    echo "<tr>
                                
                                <td style='word-break:break-all;'>
                                    " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] . "
                                </td>
        
                                <td style='word-break:break-all;'>
                                    " . $row["auto_kenteken"] . "
                                </td>
                                
                                 <td style='word-break:break-all;'>
                                    " . $start_datum . "/" . $eind_datum . "
                                </td>
                                
                                <td style='word-break:break-all;'>
                                    " . "€ " . $row["auto_model_prijs_per_dag"] . "
                                </td>
                                
                                <td style='word-break:break-all;'>
                                   " . "€ " . $data["total"] . "
                                </td>
                               
                            </tr>";
                }
            }
            echo "</table>";

        }
    }
?>
</div>

<!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>
