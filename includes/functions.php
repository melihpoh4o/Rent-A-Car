<?php

//check of je nog ingelogd bent
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

//laat pagina alleen zien wanner ingelogd als admin
function check_gebruiker_nav($conn){

    $id_medewerker = $_SESSION['id_medewerker'];

    if ($id_medewerker == 1){
        echo "<li><a class='dropdown-item' href='instellingen.php'>Instellingen</a></li>";
    }

    else if ($id_medewerker && $_SESSION['id_medewerker'] !== 1){
        echo "";
    }
}

//verander de Rol tekst als je ingelogd bent als admin
function admin_check($conn){

    $id_medewerker = $_SESSION['id_medewerker'];

    if ($id_medewerker == 1){
        echo "Admin";
    }

    else if ($id_medewerker && $_SESSION['id_medewerker'] !== 1){
        echo "Medewerker";
    }
}


function admin_gebruiker_check($conn){

    $id_medewerker = $_SESSION['id_medewerker'];


    if ($id_medewerker == 1) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $sql = "SELECT * FROM klant";
            $results = mysqli_query($conn, $sql);

            $sql_medewerker = "SELECT * 
                           FROM medewerker
                           WHERE id_medewerker != '1'";
            $results_medewerker = mysqli_query($conn, $sql_medewerker);


            if ($_POST['gebruikers'] == 1) {
                echo "<table class='table table-striped'><tr><th scope='col'>Naam</th><th scope='col'>Email</th>
                        <th>GOEDKEUREN</th><th> VERDWIJDEREN</th></tr>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["klant_email"] . "
                        </td style='word-break:break-all;'>
                       
                        <td style='word-break:break-all;'>
                            <button class='btn bg-success text-white' type='submit' value='goedkeuren' name='goedkeuren'>VERSTUUR</button>
                        </td>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";
                }

                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["medewerker_email"] . "
                        </td style='word-break:break-all;'>
                        
                        <td style='word-break:break-all;'>
                        </td>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";

                }
                echo "</table>";
            }


            if ($_POST['gebruikers'] == 2) {
                if ($results && mysqli_num_rows($results) > 0 || $results_medewerker && mysqli_num_rows($results_medewerker) > 0) {
                    echo "<table class='table table-striped'><tr><th scope='col'>Naam</th><th scope='col'>Email</th>
                        <th>GOEDKEUREN</th><th> VERDWIJDEREN</th></tr>";
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["klant_email"] . "
                        </td style='word-break:break-all;'>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-success text-white' type='submit' value='goedkeuren' name='goedkeuren'>VERSTUUR</button>
                        </td>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";
                    }
                    echo "</table>";

                }
            }

            if ($_POST['gebruikers'] == 3) {
                echo "<table class='table table-striped'><tr><th scope='col'>Naam</th><th scope='col'>Email</th>
                        <th> VERDWIJDEREN</th></tr>";
                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["medewerker_email"] . "
                        </td style='word-break:break-all;'>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";

                }
                echo "</table>";
            }
        }

    }
}

//gegevens van gebruiker bijwerken
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
                header("Location: account.php");
            }
        }

        else if (isset($_POST['inloggegevens_medewerker'])){
            $query_inlog_medewerker = "UPDATE medewerker 
                      SET medewerker_email = '$email', 
                          medewerker_wachtwoord = '$wachtwoord'
                      WHERE id_medewerker = '$id_medewerker' ";
            mysqli_query($conn,$query_inlog_medewerker);
            header("Location: account.php");
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
                header("Location: account.php");
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
                header("Location: account.php");
            }
        }

    }

}





