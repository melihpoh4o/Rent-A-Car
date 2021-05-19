<?php
session_start();

require 'includes/header.php';
require 'includes/db.php';
require 'includes/functions.php';

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

    if(!empty($voornaam) && !empty($achternaam) && !is_numeric($voornaam) && !is_numeric($achternaam)
        && !empty($straat) && !empty($huisnummer) && !empty($postcode) && !empty($plaats)  && !empty($email) && !empty($wachtwoord)) {

        //save to database
        $query = "INSERT INTO klant (klant_voornaam,klant_tussenvoegsel,klant_achternaam,klant_straat,klant_huisnummer,
                   klant_postcode,klant_plaats,klant_email,klant_wachtwoord,klant_tel)
                 VALUES ('$voornaam','$tussenvoegsel','$achternaam','$straat','$huisnummer','$postcode','$plaats',
                        '$email','$wachtwoord','$tel')";

        mysqli_query($conn,$query);
        header("Location: login.php");
        die;
    }

    else{
        echo "Please enter some valid information";
    }

}


?>

<div class="row justify-content-center p-5 mb-3 ">

    <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

    <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light rounded" method="post"   style="background-color: #1D334A">

            <h3 class="mb-3">ACCOUNT AANMAKEN</h3>

            <div class="form-group mb-3">
                <input type="text" name="voornaam" class="form-control" placeholder="Voornaam" " >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="tussenvoegsel" class="form-control" id="text" placeholder="Tussenvoegsel" >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="achternaam" class="form-control"  placeholder="Achternaam" >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="straat" class="form-control" id="text" placeholder="Straat" >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="huisnummer" class="form-control"  placeholder="Huisnummer" >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="postcode" class="form-control" placeholder="Postcode" >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="plaats" class="form-control" placeholder="Plaats" >
            </div>

            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="E-mailadres"  aria-describedby="emailHelp">
            </div>

            <div class="form-group mb-3">
                <input type="password" name="wachtwoord" class="form-control"placeholder="Wachtwoord"  >
            </div>

            <div class="form-group mb-3">
                <input type="tel" name="tel" class="form-control" placeholder="Telefoon" >
            </div>

            <button type="submit" name="submit" class="btn  mt-3 bg-light">ACCOUNT MAKEN</button>

        </form>

    <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

</div>

<?php
require 'includes/footer.php';

?>

