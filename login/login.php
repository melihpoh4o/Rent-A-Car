<?php
session_start();

require '../includes/db.php';
require '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = getDB();

    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    if(!empty($email) && !empty($wachtwoord)) {

        //read from the database
        $query = "SELECT * 
                  FROM klant 
                  WHERE klant_email = '$email' limit 1";

        $query_2 = "SELECT * 
                  FROM medewerker 
                  WHERE medewerker_email = '$email' limit 1";

        $klant_result =  mysqli_query($conn,$query);
        $medewerker_result =  mysqli_query($conn,$query_2);

        //check if result is succesfull
        if ($klant_result){
            if ($klant_result && mysqli_num_rows($klant_result) > 0){

                $user_data = mysqli_fetch_assoc($klant_result);

                if ($user_data['klant_wachtwoord'] === $wachtwoord && $user_data['klant_email'] === $email ){
                    $_SESSION['id_klant'] = $user_data['id_klant'];
                    header("Location: ../index.php");
                    die;
                } else {
                    echo "<p class='text-danger p-1'>We hebben geen klant account gevonden met dat e-mailadres of wachtwoord. 
                            Controleer of je ze juist hebt ingevoerd</p class='text-danger'>";
                }


            }

        }

        if ($medewerker_result){
            if ($medewerker_result && mysqli_num_rows($medewerker_result) > 0){

                $user_data = mysqli_fetch_assoc($medewerker_result);

                if ($user_data['medewerker_wachtwoord'] === $wachtwoord && $user_data['medewerker_email'] === $email ){
                    $_SESSION['id_medewerker'] = $user_data['id_medewerker'];
                    header("Location: ../index.php");
                    die;
                } else {
                    echo "<p class='text-danger p-1'>We hebben geen medewerker account gevonden met dat e-mailadres of wachtwoord. 
                                Controleer of je ze juist hebt ingevoerd</p>";
                }
            }

        }
    } else{
        echo "<p class='text-danger p-1'>Je hebt geen informatie ingevoerd</p>";
    }



}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Rent-A-Car</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>

<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark container-fluid p-4" style="background-color: #0E294B">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav" >

        <ul class="navbar-nav menu-link">

            <li class="nav-item ">
                <a class="nav-link"  href="../index.php">HOME</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">AUTO HUREN</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">CONTACT</a>
            </li>

        </ul>

        <ul class='navbar-nav ml-auto ms-auto'>

            <li class='nav-item'>
                <a class='nav-link' href='login.php'> INLOGGEN </a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='signup.php'> ACCOUNT MAKEN </a>
            </li>
        </ul>

    </div>

</nav>


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

            <button  type="submit" name="login" value="Login" class="btn mb-3  mt-3 bg-light">INLOGGEN</button>

    </form>


    <h3 class="mt-5 border-bottom border-3 border-secondery "></h3>

</div>

<?php
require '../includes/footer.php';

?>


