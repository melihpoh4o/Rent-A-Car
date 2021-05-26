<?php

session_start();

//require functions
require 'functions/db.php';
require 'functions/check_login_gegevens.php';

//call functions
$conn = getDB();
check_login_gegevens($conn);

?>

    <!-- Voeg html header toe -->
<?php require 'includes/header.php' ?>

    <!-- Guest navbar -->
<?php require 'includes/guest_navbar.php' ?>

    <!--  Content van de pagina -->
    <div class="row justify-content-center p-5">

        <h3 class="mb-3 border-bottom border-3 border-secondery  "></h3>

        <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light shadow-lg rounded  text-dark" method="post" >

            <h3 class="mb-3 ">INLOGGEN</h3>

            <div class="form-group mb-3">
                <input type="email" class="form-control shadow " name="email" placeholder="E-mailadres" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <input type="password" class="form-control shadow " name="wachtwoord" placeholder="Wachtwoord" >
            </div>

            <button  type="submit" name="login" class="btn btn-secondary mb-3 mt-3 bg-light text-dark">INLOGGEN</button>

        </form>


        <h3 class="mt-5 border-bottom border-3 border-secondery "></h3>

    </div>

    <!-- Voeg footer toe -->
<?php require 'includes/footer.php' ?>