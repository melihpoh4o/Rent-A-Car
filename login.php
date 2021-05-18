<?php
    require 'includes/header.php';
?>

<div class="row justify-content-center p-5">
    <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light rounded" method="post" style="background-color: #1D334A">
        <form>
            <div class="form-group mb-3">
                <label class="mb-1" for="exampleInputEmail1">E-mailadres</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Wachtwoord</label>
                <input type="password" class="form-control" id="exampleInputPassword1" >
            </div>

            <button type="submit" class="btn  mt-3 bg-light">INLOGGEN</button>
        </form>
    </form>
</div>

<?php
require 'includes/footer.php';

?>


