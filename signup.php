<?php

//check login
session_start();

//require functions
require 'functions/db.php';
require 'functions/sign_up.php';

//call functions
$conn = getDB();
sign_up($conn);
?>

    <!-- Voeg html header toe -->
<?php require 'includes/header.php' ?>

    <!-- Guest navbar -->
<?php require 'includes/guest_navbar.php' ?>

    <!--  Content van de pagina -->
    <div class="row justify-content-center p-5 mb-3 ">

        <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

        <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light rounded" method="post"   style="background-color: #1D334A">

            <h3 class="mb-3">ACCOUNT AANMAKEN</h3>

            <div class="form-group mb-3">
                <input type="text" name="voornaam" class="form-control" placeholder="Voornaam " required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="tussenvoegsel" class="form-control" id="text" placeholder="Tussenvoegsel"  >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="achternaam" class="form-control"  placeholder="Achternaam" required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="straat" class="form-control" id="text" placeholder="Straat" required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="huisnummer" class="form-control" placeholder="Huisnummer " required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="postcode" class="form-control" placeholder="Postcode" required >
            </div>

            <div class="form-group mb-3">
                <input type="text" name="plaats" class="form-control" placeholder="Plaats" required >
            </div>

            <div class="form-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="E-mailadres"  aria-describedby="emailHelp " required>
            </div>

            <div class="form-group mb-3">
                <input type="password" name="wachtwoord" class="form-control" placeholder="Wachtwoord" required >
            </div>

            <div class="form-group mb-3">
                <input type="tel" name="tel" class="form-control" placeholder="Telefoon"  >
            </div>

            <button type="submit" name="submit" class="btn  mt-3 bg-light">ACCOUNT MAKEN</button>

        </form>

        <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

    </div>

    <!-- Voeg footer toe -->
<?php require 'includes/footer.php' ?>