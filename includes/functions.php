<?php

//ben je nog ingelogd
function check_login($conn){

    function check_login_klant($conn){
        if (isset($_SESSION['id_klant'])){
            $id = $_SESSION['id_klant'];
            $query = "SELECT * FROM klant where id_klant = '$id' limit 1";

            $results = mysqli_query($conn,$query);

            if ($results && mysqli_num_rows($results) > 0){
                $user_data = mysqli_fetch_assoc($results);
                return $user_data;
            }
        }
    }

    function check_login_medewerker($conn){
        if (isset($_SESSION['id_medewerker'])){
            $id = $_SESSION['id_medewerker'];
            $query = "SELECT * FROM medewerker where id_medewerker = '$id' limit 1";

            $results = mysqli_query($conn,$query);

            if ($results && mysqli_num_rows($results) > 0){
                $user_data = mysqli_fetch_assoc($results);
                return $user_data;
            }
        }
    }

}

function update_gegevens($conn){

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id_klant = $_SESSION['id_klant'];
        $id_medewerker = $_SESSION['id_medewerker'];

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

        if (isset($_POST['inloggegevens'])) {

            if (!empty($email) && !empty($wachtwoord) ){
                $query = "UPDATE klant 
                      SET klant_email = '$email', 
                          klant_wachtwoord = '$wachtwoord'
                      WHERE id_klant = '$id_klant' ";
                mysqli_query($conn,$query);
                header("Location: accountinstellingen.php");
            }
        }

        else if (isset($_POST['inloggegevens_medewerker'])){
            $query_inlog_medewerker = "UPDATE medewerker 
                      SET medewerker_email = '$email', 
                          medewerker_wachtwoord = '$wachtwoord'
                      WHERE id_medewerker = '$id_medewerker' ";
            mysqli_query($conn,$query_inlog_medewerker);
            header("Location: accountinstellingen.php");
        }

        else if (isset($_POST['mijn_gegevens_medewerker'])){
            if (!empty($voornaam) && !empty($achternaam) && !empty($straat) && !empty($huisnummer) && !empty($postcode) && !empty($plaats) ){
                $query_mijn_gegevens_medewerker = "UPDATE medewerker
                                    SET medewerker_voornaam = '$voornaam', 
                                        medewerker_tussenvoegsel = '$tussenvoegsel', 
                                        medewerker_achternaam = '$achternaam', 
                                        medewerker_straat = '$straat', 
                                        medewerker_huisnummer = '$huisnummer', 
                                        medewerker_postcode = '$postcode', 
                                        medewerker_plaats = '$plaats', 
                                        medewerker_tel = '$tel'
                                    WHERE id_medewerker = '$id_medewerker' ";
                mysqli_query($conn,$query_mijn_gegevens_medewerker);
                header("Location: accountinstellingen.php");
            }
        }

        else if (isset($_POST['mijn_gegevens'])){
            if (!empty($voornaam) && !empty($achternaam) && !empty($straat) && !empty($huisnummer) && !empty($postcode) && !empty($plaats) ){
                $query_mijn_gegevens = "UPDATE klant 
                                    SET klant_voornaam = '$voornaam', 
                                        klant_tussenvoegsel = '$tussenvoegsel', 
                                        klant_achternaam = '$achternaam', 
                                        klant_straat = '$straat', 
                                        klant_huisnummer = '$huisnummer', 
                                        klant_postcode = '$postcode', 
                                        klant_plaats = '$plaats', 
                                        klant_tel = '$tel'
                                    WHERE id_klant = '$id_klant' ";
                mysqli_query($conn,$query_mijn_gegevens);
                header("Location: accountinstellingen.php");
            }
        }

    }

}





