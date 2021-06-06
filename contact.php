<?php

//session start
session_start();

//require functions
require 'functions/getDB.php';
require 'functions/checkIfLoggedIn.php';
require 'functions/checkNavGebruiker.php';

//call functions
$conn = getDB();
checkIfLoggedIn($conn);

//set variables tp check if medewerker or klant is logged in
$medewerker = checkLoginMedewerker($conn);
$klant = checkLoginKlant($conn);


?>

    <!-- Voeg html header toe -->
<?php require 'includes/header.php'?>

<?php if ($klant || $medewerker): ?>
    <!--Logged in navbar-->
    <nav class="shadow-lg rounded navbar navbar-expand-lg navbar-light bg-light container-fluid p-4 text-color">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav" >
            <!--navbar left-->
            <ul class="navbar-nav menu-link ">
                <li class="nav-item ">
                    <a class="nav-link "  href="index.php">HOME</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="reserveer.php">RESERVEER</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="contact.php">CONTACT</a>
                </li>
            </ul>


            <!--navbar right-->
            <div class="navbar-collapse" id="navbarNavDarkDropdown ">
                <ul class="navbar-nav ml-auto ms-auto   ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle " viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu " style="right: 0; left: auto">
                            <li><a class="dropdown-item" href="pages/account.php">Account</a></li>
                            <!--check if klant is logged in-->
                            <?php if ($klant)
                                echo "<li><a class='dropdown-item' href='./pages/factuur.php'>Factuur</a></li>";
                            ?>
                            <!--call function nav-->
                            <?php if ($medewerker) checkNavGebruiker($conn) ?>
                            <li><a class="dropdown-item" href="pages/logout.php">Uitloggen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

<?php else : ?>
    <!-- Guest navbar -->
    <?php require 'includes/guest_navbar.php'?>

<?php endif; ?>

    <!--  Content van de pagina -->
    <div class="container-fluid">
        <div class="row align-items-start g-4 m-2 mb-5">
            <h3>Contact</h3>
            <div class="col-sm col-sm-8">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab asperiores aut autem consectetur culpa
                    dolore dolorem dolores ipsa mollitia numquam optio, quaerat quis quod quos, recusandae sint soluta sunt tempora.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae blanditiis corporis culpa ea
                    earum est eveniet harum incidunt maiores minima, natus nesciunt perferendis quaerat reiciendis repellat soluta tenetur totam veniam.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus asperiores assumenda aut
                    autem consequatur consequuntur enim eum fugiat iure magni nam, nemo officia reprehenderit
                    repudiandae rerum sed similique soluta totam.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aperiam assumenda magni, molestias
                    quis reiciendis totam voluptates. Atque maiores maxime possimus quas quasi qui sed suscipit totam velit?
                    Dolores, eos.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium animi debitis inventore maiores
                    repudiandae tenetur vitae voluptatibus! Asperiores atque cum delectus, ducimus laborum mollitia neque
                    porro quia quos similique ullam.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci aperiam architecto aut,
                    cupiditate dolor dolore doloremque error est et fugit id iusto mollitia natus nesciunt porro qui repellendus veniam.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad corporis culpa dolorem
                    ducimus hic illum molestiae porro? Cum deleniti enim laboriosam maxime praesentium reiciendis sequi.
                    Consequuntur magnam porro voluptatem? Earum.
                </p>
            </div>
            <div class="col-sm col-sm-4">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><p>Adres: Autopad 12</p></li>
                        <li class="list-group-item"><p>Postcode: 1335 YY</p></li>
                        <li class="list-group-item"><p>Plaats: ALMERE</p></li>
                        <li class="list-group-item"><p>Telefoon: (036) 123 45 67</p></li>
                        <li class="list-group-item"><p>E-mail: info@rent-a-car.nl</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Voeg footer toe -->
<?php require 'includes/footer.php' ?>