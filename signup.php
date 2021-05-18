<?php
require 'includes/header.php';
?>

<div class="row justify-content-center p-5">

    <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light rounded" method="post" style="background-color: #1D334A">

        <form>

            <div class="form-group mb-3">
                <label class="mb-1" for="voornaam">Voornaam</label>
                <input type="text" class="form-control" id="voornaam">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="tussenvoegsel">Tussenvoegsel</label>
                <input type="text" class="form-control" id="tussenvoegsel">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="achternaam">Achternaam</label>
                <input type="text" class="form-control" id="achternaam">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="straat">Straat</label>
                <input type="text" class="form-control" id="straat">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="huisnummer">Huisnummer</label>
                <input type="text" class="form-control" id="huisnummer">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="postcode">Postcode</label>
                <input type="text" class="form-control" id="postcode">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="plaats">Plaats</label>
                <input type="text" class="form-control" id="plaats">
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="exampleInputEmail1">E-mailadres</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="form-group mb-3">
                <label for="exampleInputPassword1">Wachtwoord</label>
                <input type="password" class="form-control" id="exampleInputPassword1" >
            </div>

            <div class="form-group mb-3">
                <label class="mb-1" for="tel">Telefoon</label>
                <input type="tel" class="form-control" id="tel">
            </div>

            <button type="submit" class="btn  mt-3 bg-light">REGISTREREN</button>

        </form>

    </form>

</div>

<?php
require 'includes/footer.php';

?>

