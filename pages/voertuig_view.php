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

//set
$get_id_model = $_GET['view'];
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
    <nav class="shadow-lg rounded navbar navbar-expand-lg navbar-light bg-light container-fluid p-4 text-color">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav menu-link">

                <li class="nav-item ">
                    <a class="nav-link"  href="../index.php">HOME</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="../voertuig_huren.php">AUTO HUREN</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../contact.php">CONTACT</a>
                </li>

            </ul>

            <div class="navbar-collapse" id="navbarNavDarkDropdown ">
                <ul class='navbar-nav ml-auto ms-auto'>

                    <li class='nav-item'>
                        <a class='nav-link' href='../login.php'> INLOGGEN </a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link' href='../signup.php'> ACCOUNT MAKEN </a>
                    </li>
                </ul>
            </div>


        </div>

    </nav>

<?php endif; ?>

<div class="mb-3 mt-3 d-flex justify-content-center ">
    <?php
    $query = "SELECT * 
                  FROM auto
                  JOIN auto_model 
                  ON auto.id_auto_model = auto_model.id_auto_model
                  WHERE auto.id_auto_model = '$get_id_model'";
    $results = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($results);

    ?>
    <form method="post" class="d-flex justify-content-center m-2">
        <div class=" card shadow-lg rounded col-md-6">
            <img class="card-img-top img-responsive" src='../image/<?php echo $data['auto_img'] ?>' alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $data['auto_model_merk'] . " " . $data['auto_model_model'] ?></h5>
                <p class="card-text"><?php echo $data['auto_info']  ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Kenteken: <?php echo $data['auto_kenteken'] ?></li>
                <li class="list-group-item">Bowjaar: <?php echo $data['auto_model_bouwjaar'] ?></li>
                <li class="list-group-item">Kilometerstand: <?php echo $data['auto_model_kilometerstand'] ?></li>
                <li class="list-group-item">Prijs per dag: <?php echo "€" . $data['auto_model_prijs_per_dag']?></li>
                <?php
                if ($data['auto_soort'] == 0){
                    echo '<li class="list-group-item">Type: Personeauto</li>';
                }
                else if ($data['auto_soort'] == 1){
                    echo '<li class="list-group-item">Type: Bestelbus</li>';
                }
                ?>
            </ul>
        </div>
    </form>
</div>


<!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>
