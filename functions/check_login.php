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
