<?php

function zoek_voertuig($conn){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['zoek_voertuigen'])){
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

            echo "<table class='table table-striped'><tr><th class='col'>Kenteken</th><th scope='col'>Model</th><th scope='col'>Bouwjaar</th>
                            <th>Kilometerstand</th><th></th></tr>";
            while ($row = mysqli_fetch_assoc($results)) {
                echo "<tr>
                            
                            <td style='word-break:break-all;'>
                                " . $row["auto_kenteken"] ."
                            </td>
    
                            <td style='word-break:break-all;'>
                                " . $row["auto_model_merk"] ."
                            </td>
                            
                            <td style='word-break:break-all;'>
                                " . $row["auto_model_bouwjaar"] . "
                            </td style='word-break:break-all;'> 
                            
                            <td style='word-break:break-all;'>
                                " . $row["auto_model_kilometerstand"] . "
                            </td style='word-break:break-all;'> 
                            
                            <td style='word-break:break-all;'>
                               <a href='../pages/voertuig_bewerken.php?edit=" . $row['id_auto_model'] . "' class='text-decoration-none btn bg-info text-light '>BEWERKEN</a>
                            </td> 
                        
                        </tr>";
            }
            echo "</table>";
        }
    }
}
