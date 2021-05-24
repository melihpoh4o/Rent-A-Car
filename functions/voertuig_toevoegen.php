<?php

session_start();

require '../includes/db.php';
require '../functions/check_login.php';
require '../functions/check_gebruiker_nav.php';

$conn = getDB();

check_login($conn);
$medewerker = check_login_medewerker($conn);
$klant = check_login_klant($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../image/".$filename;


    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $bouwjaar = $_POST['bouwjaar'];
    $kilometerstand = $_POST['kilometerstand'];
    $prijs = $_POST['prijs'];
    $kenteken = $_POST['kenteken'];
    $wagens = $_POST['wagens'];
    $status = $_POST['status'];
    $info = $_POST['info'];

    if (is_numeric($bouwjaar) || is_numeric($kilometerstand) || is_numeric($prijs)) {

        $query_auto_model = "INSERT INTO auto_model (auto_model_merk,auto_model_model,
                            auto_model_bouwjaar,auto_model_kilometerstand,auto_model_prijs_per_dag)
                         VALUES ('$merk','$model','$bouwjaar','$kilometerstand','$prijs')";

        if (mysqli_query($conn, $query_auto_model)) {
            $last_id = mysqli_insert_id($conn);

            $query_auto = "INSERT INTO auto (id_auto_model,auto_kenteken,auto_soort,auto_status,auto_info,filename)
                         VALUES ('$last_id','$kenteken','$wagens','$status','$info','$filename')";

            mysqli_query($conn, $query_auto);
            header("Location: voertuig_toevoegen.php");
        }
    }

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent-A-Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

<?php if ($klant || $medewerker): ?>
    <!-- navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg container-fluid p-4" style="background-color: #0E294B; ">

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
                    <a class="nav-link " href="#">AUTO HUREN</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="#">CONTACT</a>
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
                            <li><a class="dropdown-item" href="../account.php">Account</a></li>

                            <?php if ($medewerker == 1 ):  ?>

                            <li><a class="dropdown-item" href="../instellingen.php">Instellingen</a></li>

                            <?php endif; ?>

                            <li><a class="dropdown-item" href="../voertuigen.php">Voertuigen</a></li>

                            <li><a class="dropdown-item" href="../login/logout.php">Uitloggen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>


    </nav>

<?php else: ?>

    <?php require 'includes/static_navbar.php' ?>

<?php endif; ?>


<div class="container">

    <form class="p-5 mb-3 mt-3" method="post" enctype="multipart/form-data">
        <h3 class="mb-3" >NIEUWE VOERTUIG TOEVOEGEN</h3>

        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" placeholder="Merk" name="merk" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Model" name="model" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" placeholder="Kenteken" name="kenteken" required>
            </div>
            <div class="col">
                <input type="number" class="form-control" placeholder="Bouwjaar" name="bouwjaar">
            </div>
            <div class="col">
                <select name="kilometerstand" class="form-control"  >
                    <option value="10000" selected>Kilometerstand 0</option>
                    <option value="10000" >Kilometerstand 10.000</option>
                    <option value="25000">Kilometerstand 25.000</option>
                    <option value="50000" >Kilometerstand 50.000</option>
                    <option value="75000">Kilometerstand 75.000</option>
                    <option value="100000">Kilometerstand 100.000</option>
                    <option value="150000" >Kilometerstand 150.000</option>
                    <option value="200000">Kilometerstand 200.000</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                <input type="number" step="any" class="form-control" aria-label="Amount (to the nearest dollar)" name="prijs" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <select name="wagens" class="form-control" >
                    <option value="0" selected>Personeauto</option>
                    <option value="1">Bestelbus</option>
                </select>
            </div>
            <div class="col">
                <select name="status" id="inputState" class="form-control">
                    <option value="0" selected>Beschikbaar</option>
                    <option value="1">Verhuurd</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <textarea class="form-control"  name="info" rows="3"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <input type="hidden" name="size" value="1000000">
            <div class="col mb-3">
                <input type="file" name="uploadfile" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </div>

        <button type="submit" name="sumbit" class="btn bg-success text-white ">VERSTUUR</button>

    </form>

</div>



<script src="../js/functions.js"></script>


<?php
require '../includes/footer.php';
?>
