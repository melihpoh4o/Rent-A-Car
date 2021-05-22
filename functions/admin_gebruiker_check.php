<?php
function admin_gebruiker_check($conn){

    $id_medewerker = $_SESSION['id_medewerker'];


    if ($id_medewerker == 1) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $sql = "SELECT * FROM klant";
            $results = mysqli_query($conn, $sql);

            $sql_medewerker = "SELECT * 
                           FROM medewerker
                           WHERE id_medewerker != '1'";
            $results_medewerker = mysqli_query($conn, $sql_medewerker);


            if ($_POST['gebruikers'] == 1) {
                echo "<table class='table table-striped'><tr><th scope='col'>Naam</th><th scope='col'>Email</th>
                        <th>GOEDKEUREN</th><th> VERDWIJDEREN</th></tr>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["klant_email"] . "
                        </td style='word-break:break-all;'>
                       
                        <td style='word-break:break-all;'>
                            <button class='btn bg-success text-white' type='submit' value='goedkeuren' name='goedkeuren'>VERSTUUR</button>
                        </td>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";
                }

                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["medewerker_email"] . "
                        </td style='word-break:break-all;'>
                        
                        <td style='word-break:break-all;'>
                        </td>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";

                }
                echo "</table>";
            }


            if ($_POST['gebruikers'] == 2) {
                if ($results && mysqli_num_rows($results) > 0 || $results_medewerker && mysqli_num_rows($results_medewerker) > 0) {
                    echo "<table class='table table-striped'><tr><th scope='col'>Naam</th><th scope='col'>Email</th>
                        <th>GOEDKEUREN</th><th> VERDWIJDEREN</th></tr>";
                    while ($row = mysqli_fetch_assoc($results)) {
                        echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["klant_voornaam"] . " " . $row["klant_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["klant_email"] . "
                        </td style='word-break:break-all;'>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-success text-white' type='submit' value='goedkeuren' name='goedkeuren'>VERSTUUR</button>
                        </td>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";
                    }
                    echo "</table>";

                }
            }

            if ($_POST['gebruikers'] == 3) {
                echo "<table class='table table-striped'><tr><th scope='col'>Naam</th><th scope='col'>Email</th>
                        <th> VERDWIJDEREN</th></tr>";
                while ($row = mysqli_fetch_assoc($results_medewerker)) {
                    echo "<tr>

                        <td style='word-break:break-all;'>
                            " . $row["medewerker_voornaam"] . " " . $row["medewerker_achternaam"] . "
                        </td>
                        
                        <td style='word-break:break-all;'>
                            " . $row["medewerker_email"] . "
                        </td style='word-break:break-all;'>
                        
                        <td style='word-break:break-all;'>
                            <button class='btn bg-danger text-light' type='submit' value='verwijderen' name='verwijderen'>VERSTUUR</button>
                        </td>
                    
                    </tr>";

                }
                echo "</table>";
            }
        }

    }
}
