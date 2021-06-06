<?php
//Registreer als klant
function signUp($conn){

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
        $data = mysqli_fetch_assoc($results);

        if(!is_numeric($voornaam) && !is_numeric($achternaam) ) {

            if (mysqli_num_rows($results) > 0){
                if ($email == $data['klant_email']) {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <h6>*E-mailadres is al in gebruik</h6>
                    </div>
                    <?php
                }
            }

            if (!is_numeric($tel)){
                ?>
                <div class="alert alert-warning" role="alert">
                    <h6>*Telefoonnummer  mag alleen van cijfers bestaan</h6>
                </div>
                <?php
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
            ?>
            <div class="alert alert-warning" role="alert">
            <h6>*Voer een geldige informatie in</h6>
            </div>
            <?php
        }

    }

}
