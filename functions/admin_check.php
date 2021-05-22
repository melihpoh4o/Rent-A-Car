<?php

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

