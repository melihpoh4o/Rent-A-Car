<?php
session_start();

require '../includes/db.php';
require '../functions/check_login.php';

$conn = getDB();


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $straat = $_POST['straat'];
    $huisnummer = $_POST['huisnummer'];
    $postcode = $_POST['postcode'];
    $plaats = $_POST['plaats'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $tel = $_POST['tel'];

    $query_email = "SELECT klant_email from klant WHERE klant_email = '$email'";
    $results = mysqli_query($conn,$query_email);

    if(!is_numeric($voornaam) && !is_numeric($achternaam) ) {

        if (mysqli_num_rows($results) > 0) {
            echo "E-mailadres is al in gebruik";
        }

        if (!is_numeric($tel)){
            echo "Telefoonnummer  mag alleen van nummers bestaan";
        }

        else {
            $query = "INSERT INTO klant (klant_voornaam,klant_tussenvoegsel,klant_achternaam,klant_straat,klant_huisnummer,
                   klant_postcode,klant_plaats,klant_email,klant_wachtwoord,klant_tel)
                 VALUES ('$voornaam','$tussenvoegsel','$achternaam','$straat','$huisnummer','$postcode','$plaats',
                        '$email','$wachtwoord','$tel')";

            if (mysqli_query($conn, $query)){
                header("Location: login.php");
                die;
            }
        }
    }

    else {
        echo "Voer een geldige informatie in";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Rent-A-Car</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>

<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark container-fluid p-4" style="background-color: #0E294B">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav" >

        <ul class="navbar-nav menu-link">

            <li class="nav-item ">
                <a class="nav-link"  href="../index.php">HOME</a>
            </li>
            s
            <li class="nav-item">
                <a class="nav-link" href="#">AUTO HUREN</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">CONTACT</a>
            </li>

        </ul>

        <ul class='navbar-nav ml-auto ms-auto'>

            <li class='nav-item'>
                <a class='nav-link' href='login.php'> INLOGGEN </a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='signup.php'> ACCOUNT MAKEN </a>
            </li>
        </ul>

    </div>

</nav>


<div class="row justify-content-center p-5 mb-3 ">

    <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

    <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light rounded" method="post"   style="background-color: #1D334A">

            <h3 class="mb-3">ACCOUNT AANMAKEN</h3>

            <div class="form-group mb-3">
                <input type="text" name="voornaam" class="form-control" placeholder="Voornaam " required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="tussenvoegsel" class="form-control" id="text" placeholder="Tussenvoegsel"  >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="achternaam" class="form-control"  placeholder="Achternaam" required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="straat" class="form-control" id="text" placeholder="Straat" required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="huisnummer" class="form-control" placeholder="Huisnummer " required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="postcode" class="form-control" placeholder="Postcode" required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="plaats" class="form-control" placeholder="Plaats" required >
            </div>

            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="E-mailadres"  aria-describedby="emailHelp " required>
            </div>

            <div class="form-group mb-3">
                <input type="password" name="wachtwoord" class="form-control"placeholder="Wachtwoord" required >
            </div>

            <div class="form-group mb-3">
                <input type="tel" name="tel" class="form-control" placeholder="Telefoon"  >
            </div>

            <button type="submit" name="submit" class="btn  mt-3 bg-light">ACCOUNT MAKEN</button>

        </form>

    <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

</div>

<?php
require '../includes/footer.php';

?>

