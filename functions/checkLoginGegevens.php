<?php

//require function
require 'functions/factuurAanmaken.php';

//check gegevens for login
function checkLoginGegevens($conn){

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = getDB();

        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];

        if(!empty($email) && !empty($wachtwoord)) {

            //read from the database
            $query = "SELECT * 
                      FROM klant 
                      WHERE klant_email = '$email' limit 1";

            $query_2 = "SELECT * 
                      FROM medewerker 
                      WHERE medewerker_email = '$email' limit 1";

            $klant_result =  mysqli_query($conn,$query);
            $medewerker_result =  mysqli_query($conn,$query_2);

            //check if result is succesfull
            if ($klant_result){
                if ($klant_result && mysqli_num_rows($klant_result) > 0){

                    $user_data = mysqli_fetch_assoc($klant_result);

                    if ($user_data['klant_wachtwoord'] === $wachtwoord && $user_data['klant_email'] === $email){
                        $_SESSION['id_klant'] = $user_data['id_klant'];
                        factuurAanmaken($conn);
                        header("Location: index.php");
                        die;
                    } else {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            <h6>*We hebben geen klant account gevonden met dat e-mailadres of wachtwoord.
                                Controleer of je ze juist hebt ingevoerd</h6>
                        </div>
                        <?php
                    }
                }

            }

            if ($medewerker_result){
                if ($medewerker_result && mysqli_num_rows($medewerker_result) > 0){

                    $user_data = mysqli_fetch_assoc($medewerker_result);

                    if ($user_data['medewerker_wachtwoord'] === $wachtwoord && $user_data['medewerker_email'] === $email){
                        $_SESSION['id_medewerker'] = $user_data['id_medewerker'];
                        header("Location: index.php");
                        die;
                    } else {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            <h6>*We hebben geen medewerker account gevonden met dat e-mailadres of wachtwoord.
                                Controleer of je ze juist hebt ingevoerd</h6>
                        </div>
                        <?php
                    }
                }

            }
        } else{
            ?>
            <div class="alert alert-warning" role="alert">
                <h6>*Je hebt geen informatie ingevoerd</h6>
            </div>
            <?php
        }


    }
}
