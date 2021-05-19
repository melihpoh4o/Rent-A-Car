<?php

session_start();

require 'includes/header.php';
require 'includes/db.php';
require 'includes/functions.php';


$conn = getDB();
$user_data = check_login($conn);


?>

<div class="container-fluid p-4 mb-5 ">
    <div class="row">
        <a href="logout.php">Log uit</a>
        Hello<?php echo $user_data['klant_voornaam']?>
        <h2 class="text-center">INFO BEDRIJF</h2>
    </div>

    <div class="row">

        <div class="col-md-4">
            <img class="img-fluid" src="https://source.unsplash.com/random/600x400?sig=1" alt="" />

        </div>

        <div class="col-md-4">
            <img class="img-fluid" src="https://source.unsplash.com/random/600x400?sig=2" alt="" />

        </div>

        <div class="col-md-4">
            <img class="img-fluid" src="https://source.unsplash.com/random/600x400?sig=3" alt="" />

        </div>

    </div>

</div>

<?php
    require 'includes/footer.php';
?>