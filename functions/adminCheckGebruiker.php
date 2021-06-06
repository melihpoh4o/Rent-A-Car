<?php
//check gebruikers admin
function adminCheckGebruiker($conn){

    $id_medewerker = $_SESSION['id_medewerker'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        if ($id_medewerker == 1) {

            $sql = "SELECT * FROM klant";
            $results = mysqli_query($conn, $sql);

            $sql_medewerker = "SELECT * 
                               FROM medewerker
                               WHERE id_medewerker != '1'";
            $results_medewerker = mysqli_query($conn, $sql_medewerker);

            if ($_POST['gebruikers'] == 1) {

                echo "<div class='table-responsive'><table class='table table-hover table-md'><thead><tr><th class='col'>Rol</th><th scope='col'>Naam</th><th scope='col'>Email</th>
                            <th>GOEDKEUREN</th><th>VERWIJDEREN</th></tr></thead>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>
                            
                            <td>
                                <p>Klant</p>
                            </td>
                            
                            <td >
                                " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] ."
                            </td>
                            
                            <td >
                                " . $row["klant_email"] . "
                            </td>
                            
                            <td >
                               <a href='../pages/klant_goedkeuren.php?edit=" . $row['id_klant'] . "' class='btn btn-success bg-light text-dark'>VERSTUUR</a>
                            </td> 
                            
                            <td>
                            </td>
 
                        </tr>";
                }

                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>
                            
                            <td>
                                <p>Medewerker</p>
                            </td>
                            
                            <td>
                                " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                            </td>
                            
                            <td>
                                " . $row["medewerker_email"] . "
                            </td>
                            
                            <td>
                            </td>
                            
                            <td>
                               <a href='../pages/delete_medewerker.php?edit=" . $row['id_medewerker'] . "' class='btn btn-danger bg-light text-dark'>VERSTUUR</a>
                            </td> 

                        </tr>";

                }
                echo "</table></div>";
            }


            if ($_POST['gebruikers'] == 2) {
                echo "<div class='table-responsive'><table class='table table-hover table-md'><thead><tr><th class='col'>Rol</th><th scope='col'>Naam</th><th scope='col'>Email</th>
                            <th>GOEDKEUREN</th></tr></thead>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>
                            
                            <td>
                                <p>Klant</p>
                            </td>
    
                            <td>
                                " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] . "
                            </td>
                            
                            <td>
                                " . $row["klant_email"] . "
                            </td> 
                            
                            <td>
                               <a href='../pages/klant_goedkeuren.php?edit=". $row['id_klant'] . "' class='btn btn-success bg-light text-dark'>VERSTUUR</a>
                            </td> 
                           
                        
                        </tr>";
                }
                echo "</table></div>";
            }

            if ($_POST['gebruikers'] == 3) {
                echo "<div class='table-responsive'><table class='table table-hover table-md'><thead><tr><th class='col'>Rol</th><th scope='col'>Naam</th><th scope='col'>Email</th>
                            <th>VERWIJDEREN</th></tr></thead>";
                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>
                                
                            <td>
                                <p>Medewerker</p>
                            </td>
                                
                            <td>
                                " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                            </td>
                            
                            <td>
                                " . $row["medewerker_email"] . "
                            </td>
                            
                            <td>
                               <a href='../pages/delete_medewerker.php?edit=" . $row['id_medewerker'] . "' class='btn btn-danger bg-light text-dark'>VERSTUUR</a>
                            </td> 
                            
                        </tr>";
                }
                echo "</table></div>";


            } else {
                echo "";
            }
        }
    }


}

