<?php
session_start();

require 'includes/header.php';
require 'includes/db.php';
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = getDB();

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

<div class="row justify-content-center p-5">

    <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light rounded" method="post"   style="background-color: #1D334A">

            <div class="form-group mb-3">
                <label class="mb-1" for="voornaam" >Voornaam</label>
                <input type="text" name="voornaam" class="form-control" id="text" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for=tussenvoegsel"">Tussenvoegsel</label>
                <input type="text" name="tussenvoegsel" class="form-control" id="text" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="achternaam" >Achternaam</label>
                <input type="text" name="achternaam" class="form-control" id="text" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="straat" >Straat</label>
                <input type="text" name="straat" class="form-control" id="text" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="huisnummer" >Huisnummer</label>
                <input type="text" name="huisnummer" class="form-control" id="text" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="postcode" >Postcode</label>
                <input type="text" name="postcode" class="form-control" id="text" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="plaats" >Plaats</label>
                <input type="text" name="plaats" class="form-control" id="text" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="email" >E-mailadres</label>
                <input type="email" name="email" class="form-control" id="text"  aria-describedby="emailHelp">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="wachtwoord">Wachtwoord</label>
                <input type="password" name="wachtwoord" class="form-control" id="text"  >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="tel">Telefoon</label>
                <input type="tel" name="tel" class="form-control" id="text" >
            </div>

            <button type="submit" name="submit" class="btn  mt-3 bg-light">ACCOUNT MAKEN</button>

        </form>

</div>

<?php
require 'includes/footer.php';

?>

