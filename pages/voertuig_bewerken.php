<?php

//start session
session_start();

//require functions
require '../functions/getDB.php';
require '../functions/checkIfLoggedIn.php';
require '../functions/checkNavGebruiker.php';
require '../functions/infoVoertuigBewerken.php';
require '../functions/deleteVoertuig.php';
require '../functions/navigatieGebruiker.php';

//call functions
$conn = getDB();
checkIfLoggedIn($conn);

//set variables tp check if medewerker or klant is logged in
$medewerker = checkLoginMedewerker($conn);
$klant = checkLoginKlant($conn);

//set car variable
$auto = infoVoertuigBewerken($conn);

//call delete car function
deleteVoertuig($conn);

// get_id from auto_model
$get_id = $_GET['edit'];


?>

    <!-- Voeg html header toe -->
<?php require '../includes/header.php' ?>

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
                            <!--call function-->
                            <?php navigatieGebruiker($conn) ?>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

<?php else : ?>
    <!-- Guest navbar -->
    <?php require '../includes/guest_navbar.php' ?>

<?php endif; ?>

    <!--  Content van de pagina -->
    <div class="container p-4 mb-3 ">

        <div class="row">

            <div class="col-md-12">

                <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>


                <form class="p-5 mt-3 mb-3 text-light shadow-lg rounded" method="post" enctype="multipart/form-data" >

                    <h3 class="mb-3 text-dark">VOERTUIG</h3>

                    <div class="form-group mb-3">
                        <input type="text" name="auto_model_merk" class="form-control" placeholder="Auto merk" value="<?php echo "" . $auto['auto_model_merk']?>" required  >
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="auto_model_model" class="form-control" placeholder="Auto model" value="<?php echo "" . $auto['auto_model_model'] ?>" required  >
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" name="auto_kenteken" class="form-control" placeholder="Kenteken" value="<?php echo "". $auto['auto_kenteken'] ?>"  required>
                    </div>

                    <div class="form-group mb-3">
                        <input type="number" name="auto_model_bouwjaar"  class="form-control" placeholder="Auto bouwjaar" value="<?php echo "". $auto['auto_model_bouwjaar'] ?>" >
                    </div>

                    <div class="form-group mb-3">
                        <select name="auto_soort" class="form-control" required >
                            <?php if ($auto['auto_soort'] == 0) :  ?>
                                <option value="0" selected>Personeauto</option>
                                <option value="1">Bestelbus</option>
                            <?php elseif ($auto['auto_soort'] == 1) :  ?>
                                <option value="0" selected>Personeauto</option>
                                <option value="1" selected>Bestelbus</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <select name="auto_status" class="form-control" required>
                            <?php if ($auto['auto_status'] == 0) :  ?>
                                <option value="0" selected>Beschikbaar  </option>
                                <option value="1">Niet Beschikbaar</option>
                            <?php elseif ($auto['auto_status'] == 1) :  ?>
                                <option value="0">Beschikbaar</option>
                                <option value="1" selected>Niet Beschikbaar</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <textarea class="form-control" name="auto_info" rows="3"><?php echo "". $auto['auto_info']?></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <!--options for kilometerstand-->
                        <?php
                        $kilometerstand = array("0", "10000", "25000", "50000", "75000", "100000" ,"125000", "150000", "200000","250000","300000");
                        echo "<select name='auto_model_kilometerstand' class='form-control' >";
                        foreach ($kilometerstand as $kilometer) {
                            echo '<option value="'.$kilometer.'"';
                            if ($kilometer == $auto["auto_model_kilometerstand"]) {
                                echo 'selected="selected"';
                            }
                            echo '>'.$kilometer.'</option>';;
                        }
                        echo "</select>";
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">???</span>
                            </div>
                            <input required type="number" step="any" class="form-control" aria-label="Amount (to the nearest dollar)" name="auto_model_prijs_per_dag" value="<?php echo "". $auto['auto_model_prijs_per_dag'] ?>">
                        </div>
                    </div>
                    <?php
                    //query
                    $query = "SELECT * FROM auto WHERE id_auto_model = '$get_id'";
                    $results = mysqli_query($conn, $query);
                    $user_data = mysqli_fetch_assoc($results);
                    ?>
                    <div class="row mb-3">
                        <input type="file" name="uploadfile" class="form-control-file mb-3 text-dark">
                            <!--load image only if image is uploaded-->
                            <?php if (empty($user_data['auto_img']) || is_null($user_data['auto_img'])): echo "";?>
                            <?php else: ?>
                            <img class="img-fluid" alt="Responsive image" src="<?php echo "../image/" .$auto['auto_img']; ?>">
                            <?php endif; ?>
                    </div>
                    <button type="submit" name="opslaan" class="btn btn-success bg-light text-dark ">OPSLAAN</button>
                    <button type="submit" name="delete" class="btn btn-danger bg-light text-dark ">VERWIJDEREN</button>

                </form>

                <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

            </div>

        </div>

    </div>


    <!-- Voeg footer toe -->
<?php require '../includes/footer.php' ?>