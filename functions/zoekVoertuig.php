<?php

//zoek voor voertuig
function zoekVoertuig($conn){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['zoek_voertuigen'])) {
            $query = "SELECT
                      id_auto,
                      auto.id_auto_model,
                      auto_kenteken,
	                  auto_model_merk,
	                  auto_model_bouwjaar,
	                  auto_model_kilometerstand
	                  FROM auto
	                  JOIN auto_model ON auto.id_auto_model = auto_model.id_auto_model;";

            $results = mysqli_query($conn, $query);
            if ($results && mysqli_num_rows($results) > 0) {
                echo "<div class='table-responsive'><table class='table table-hover table-md'><thead><tr><th class='col'>Kenteken</th><th scope='col'>Model</th><th scope='col'>Bouwjaar</th>
                            <th>Kilometerstand</th><th></th></tr></thead>";
                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<tr>
                            
                            <td>
                                " . $row["auto_kenteken"] . "
                            </td>
    
                            <td>
                                " . $row["auto_model_merk"] . "
                            </td>
                            
                            <td >
                                " . $row["auto_model_bouwjaar"] . "
                            </td> 
                            
                            <td >
                                " . $row["auto_model_kilometerstand"] . "
                            </td> 
                            
                            <td >
                               <a href='../pages/voertuig_bewerken.php?edit=" . $row['id_auto_model'] . "' class='btn btn-secondary bg-light text-dark '>BEWERKEN</a>
                            </td> 
                        
                        </tr>";
                }
                echo "</table></div>";
            }
        }
    }
}
