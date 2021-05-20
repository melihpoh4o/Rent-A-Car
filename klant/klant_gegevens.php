<?php

?>

<div class="container-fluid p-4 mb-5 ">

    <div class="row">

        <div class="col-md-4">

            <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

            <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                <h3 class="mb-3">GEGEVENS</h3>

                <div class="form-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email"  aria-describedby="emailHelp " value="<?php echo "" . $klant['klant_email']?> " required>
                </div>

                <div class="form-group mb-3">
                    <input class="form-control mb-2" type="password" name="wachtwoord" id="myInput"  placeholder="Email" value="<?php echo "" . $klant['klant_wachtwoord']?> " required >
                    <input class="form-check-input"  type="checkbox" onclick="showPassword()">
                </div>

                <button type="submit" name="inloggegevens" class="btn mt-3 bg-light">OPSLAAN</button>

            </form>

            <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

        </div>

        <div class="col-md-4">

            <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

            <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                <h3 class="mb-3">ACCOUNT</h3>

                <div class="form-group mb-3">
                    <input type="text" name="voornaam" class="form-control" placeholder="Voornaam" value="<?php echo "" . $klant['klant_voornaam']?>" required >
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="tussenvoegsel" class="form-control" id="text" placeholder="Tussenvoegsel" value="<?php echo "" . $klant['klant_tussenvoegsel']?> "  >
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="achternaam" class="form-control"  placeholder="Achternaam" value="<?php echo "" . $klant['klant_achternaam']?>" required >
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="straat" class="form-control" id="text" placeholder="Straat" value="<?php echo "" . $klant['klant_straat']?>" required >
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="huisnummer" class="form-control" placeholder="Huisnummer" value="<?php echo "" . $klant['klant_huisnummer']?>  " required >
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="postcode" class="form-control" placeholder="Postcode" value="<?php echo "" . $klant['klant_postcode']?> " required >
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="plaats" class="form-control" placeholder="Plaats" value="<?php echo $klant['klant_plaats']?> " required >
                </div>

                <div class="form-group mb-3">
                    <input type="tel" name="tel" class="form-control" placeholder="Tel" value="<?php echo "" . $klant['klant_tel']?> ">
                </div>

                <button type="submit" name="mijn_gegevens" class="btn mt-3 bg-light">OPSLAAN</button>

            </form>

            <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

        </div>

        <div class="col-md-4">

            <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

            <form class="p-5 mt-3 mb-3 text-light rounded" method="post"  style="background-color: #0E294B">

                <h3 class="mb-3">ROL</h3>

                <div class="form-group ">
                    <input class="form-control mb-2" type="text" placeholder="Klant"  value=" <?php if ($klant) echo "Klant"  ?>" readonly >
                </div>

            </form>

            <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

        </div>

    </div>

</div>