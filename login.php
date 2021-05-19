<?php
session_start();

require 'includes/header.php';
require 'includes/db.php';
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = getDB();

    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    if(!empty($email) && !empty($wachtwoord)) {

        //read from the database
        $query = "SELECT * 
                  FROM klant
                  WHERE klant_email = '$email' limit 1";

        $klant_result =  mysqli_query($conn,$query);

        //check if result is succesfull
        if ($klant_result){
            if ($klant_result && mysqli_num_rows($klant_result) > 0){

                $user_data = mysqli_fetch_assoc($klant_result);

                if ($user_data['klant_wachtwoord'] === $wachtwoord){
                    $_SESSION['id_klant'] = $user_data['id_klant'];
                    header("Location: index.php");
                    die;
                }

            }
        }
        echo "Please enter some valid information";
    }

    else{
        echo "Please enter some valid information";
    }

}
?>

<div class="row justify-content-center p-5">

    <h3 class="mb-3 border-bottom border-3 border-secondery "></h3>

    <form class="p-5 mt-3 mb-3 col-sm-6 col-md-8 col-lg-6 col-xl-3 text-light rounded" method="post" style="background-color: #1D334A">

        <h3 class="mb-3">INLOGGEN</h3>

            <div class="form-group mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mailadres" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord" >
            </div>

            <button type="submit" name="login" value="Login" class="btn  mt-3 bg-light">INLOGGEN</button>

    </form>

    <h3 class="mt-3 border-bottom border-3 border-secondery "></h3>

</div>

<?php
require 'includes/footer.php';

?>


