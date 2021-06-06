<?php


function navigatieGebruiker($conn){
    //set variables tp check if medewerker or klant is logged in
    $medewerker = checkLoginMedewerker($conn);
    $klant = checkLoginKlant($conn);

    ?>
    <?php if ($klant):?>
        <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
        <li><a class="dropdown-item" href="../pages/factuur.php">Factuur</a></li>
        <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
    <?php elseif ($medewerker && $medewerker['id_medewerker'] != 1):?>
        <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
        <li><a class="dropdown-item" href="../pages/reservering_medewerker.php">Reserveringen</a></li>
        <li><a class="dropdown-item" href="../pages/voertuigen.php">Voertuigen</a></li>
        <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
    <?php elseif ($medewerker['id_medewerker'] == 1): ?>
        <li><a class="dropdown-item" href="../pages/account.php">Account</a></li>
        <li><a class="dropdown-item" href="../pages/instellingen.php">Instellingen</a></li>
        <li><a class="dropdown-item" href="../pages/reservering_medewerker.php">Reserveringen</a></li>
        <li><a class="dropdown-item" href="../pages/voertuigen.php">Voertuigen</a></li>
        <li><a class="dropdown-item" href="../pages/logout.php">Uitloggen</a></li>
    <?php endif; ?>
    <?php

}