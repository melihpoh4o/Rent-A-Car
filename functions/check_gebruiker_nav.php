<?php

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
