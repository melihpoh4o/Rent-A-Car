<?php

//laat pagina alleen zien wanner ingelogd als admin
function check_gebruiker_nav($conn){

    $id_medewerker = $_SESSION['id_medewerker'];

    if ($id_medewerker == 1){
        echo "<li><a class='dropdown-item' href='./pages/instellingen.php'>Instellingen</a></li>";
    }

    if ($id_medewerker){
        echo "<li><a class='dropdown-item' href='./pages/reservering_medewerker.php'>Reservering </a></li>";
        echo "<li><a class='dropdown-item' href='./pages/voertuigen.php'>Voertuigen</a></li>";
    }

    else if ($id_medewerker && $_SESSION['id_medewerker'] !== 1){
        echo "";
    }
}