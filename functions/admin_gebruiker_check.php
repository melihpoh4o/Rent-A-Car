<?php
function admin_gebruiker_check($conn){

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

                echo "<table class='table table-striped'><tr><th class='col'>Rol</th><th scope='col'>Naam</th><th scope='col'>Email</th>
                            <th>GOEDKEUREN</th><th>VERWIJDEREN</th></tr>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>
                            
                            <td style='word-break:break-all;'>
                                <p>Klant</p>
                            </td>
                            
                            <td style='word-break:break-all;'>
                                " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] ."
                            </td>
                            
                            <td style='word-break:break-all;'>
                                " . $row["klant_email"] . "
                            </td style='word-break:break-all;'>
                            
                            <td style='word-break:break-all;'>
                               <a href='functions/klant_goedkeuren.php?edit=" . $row['id_klant'] . "' class='text-decoration-none btn bg-success text-light '>VERSTUUR</a>
                            </td> 
                            
                            <td style='word-break:break-all;'>
                            </td style='word-break:break-all;'>
 
                        </tr>";
                }

                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>
                            
                            <td style='word-break:break-all;'>
                                <p>Medewerker</p>
                            </td>
                            
                            <td style='word-break:break-all;'>
                                " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                            </td>
                            
                            <td style='word-break:break-all;'>
                                " . $row["medewerker_email"] . "
                            </td style='word-break:break-all;'>
                            
                            <td style='word-break:break-all;'>
                            </td style='word-break:break-all;'>
                            
                            <td style='word-break:break-all;'>
                               <a href='functions/delete_medewerker.php?edit=" . $row['id_medewerker'] . "' class='text-decoration-none btn bg-danger text-light '>VERSTUUR</a>
                            </td> 

                        </tr>";

                }
                echo "</table>";
            }


            if ($_POST['gebruikers'] == 2) {
                    echo "<table class='table table-striped'><tr><th class='col'>Rol</th><th scope='col'>Naam</th><th scope='col'>Email</th>
                            <th>GOEDKEUREN</th></tr>";
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<tr>
                            
                            <td style='word-break:break-all;'>
                                <p>Klant</p>
                            </td>
    
                            <td style='word-break:break-all;'>
                                " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] . "
                            </td>
                            
                            <td style='word-break:break-all;'>
                                " . $row["klant_email"] . "
                            </td style='word-break:break-all;'> 
                            
                            <td style='word-break:break-all;'>
                               <a href='functions/klant_goedkeuren.php?edit=" . $row['id_klant'] . "' class='text-decoration-none btn bg-success text-light '>VERSTUUR</a>
                            </td> 
                           
                        
                        </tr>";
                    }
                    echo "</table>";
            }

            if ($_POST['gebruikers'] == 3) {
                echo "<table class='table table-striped'><tr><th class='col'>Rol</th><th scope='col'>Naam</th><th scope='col'>Email</th>
                            <th>VERWIJDEREN</th></tr>";
                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>
                                
                            <td style='word-break:break-all;'>
                                <p>Medewerker</p>
                            </td>
                                
                            <td style='word-break:break-all;'>
                                " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                            </td>
                            
                            <td style='word-break:break-all;'>
                                " . $row["medewerker_email"] . "
                            </td style='word-break:break-all;'>
                            
                            <td style='word-break:break-all;'>
                               <a href='functions/delete_medewerker.php?edit=" . $row['id_medewerker'] . "' class='text-decoration-none btn bg-danger text-light '>VERSTUUR</a>
                            </td> 
                            
                        </tr>";
                }
                echo "</table>";


            } else {
                echo "";
            }
        }
    }


}

