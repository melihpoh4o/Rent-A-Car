<?php
//zoek voor beschikbare voertuigen
function zoekVoorVoertuig($conn){
    if (isset($_POST['voeg_auto_toe'])){
        $start_datum = $_POST['start_datum_voertuig'];
        $eind_datum = $_POST['eind_datum_voertuig'];
        $query = "SELECT * 
                  FROM auto
                  JOIN auto_model 
                  ON auto.id_auto_model = auto_model.id_auto_model 
                  JOIN reservering on auto.id_auto = reservering.id_auto";
        $results = mysqli_query($conn,$query);

        if ($eind_datum < $start_datum || $start_datum == date('Y-m-d')){
            ?>
            <div class="col-md-12 shadow-lg alert alert-muted text-center" role="alert">
                <p class='text-center'>Verkeerde datum probeer het opnieuw</p>
            </div>
            <?php
            die();
        }
        else {

            while ($data = mysqli_fetch_assoc($results)) {
                if ($start_datum <= $data['reserveringe_eind_datum'] && $eind_datum >= $data['reservering_start_datum']){
                    $sql_upate_status_reserveert = "UPDATE auto 
                                                        JOIN reservering
                                                        ON reservering.id_auto = auto.id_auto
                                                        SET auto.auto_status_reservering = 1
                                                        WHERE '$start_datum' <= reservering.reserveringe_eind_datum
                                                        AND '$eind_datum' >= reservering.reservering_start_datum";
                    $results_update = mysqli_query($conn,$sql_upate_status_reserveert);
                }
                else{
                    $sql_upate_status = "UPDATE auto 
                                             JOIN reservering
                                             ON reservering.id_auto = auto.id_auto
                                             SET auto.auto_status_reservering = 0
                                             WHERE '$start_datum' > reservering.reserveringe_eind_datum
                                             OR '$eind_datum' < reservering.reservering_start_datum";
                    $results_update_status = mysqli_query($conn,$sql_upate_status);
                }
            }
        }

        $query_show = "SELECT * 
                       FROM auto
                       JOIN auto_model 
                       ON auto.id_auto_model = auto_model.id_auto_model";
        $results_show = mysqli_query($conn,$query_show);
        $i = 1;
        if ($_POST['voertuigen'] == 1){
            while ($data_show = mysqli_fetch_assoc($results_show)){
                if ($data_show['auto_status_reservering'] == 0) {
                    if ($data_show['auto_soort'] == 0 && $data_show['auto_status'] == 0){
                        ?>
                        <div class='card-group '>
                            <div class="card shadow-lg rounded">
                                <img height="50%" class='card-img-top' src='image/<?php echo $data_show['auto_img'] ?>'>
                                <div class="card-body bg-light">
                                    <a class="text-secondary shadow-lg rounded" href="./pages/voertuig_view.php?view=<?php echo $data_show['id_auto']
                                    ?>&start_datum=<?php echo $start_datum?>&eind_datum=<?php echo $eind_datum?>">
                                        <h5 class="card-title text-dark"><?php echo $data_show['auto_model_merk'] . " " . $data_show['auto_model_model'] ?></h5>
                                    </a>
                                    <p class="card-text text-secondary" ><?php echo $data_show['auto_info']?></p>
                                </div>
                            </div>
                        </div>
                        <?php if($i % 3 === 0) echo "</div><div class='row row-cols-1 row-cols-md-3 g-4 m-2'>"; ?>
                        <?php $i++; ?>
                        <?php
                    }
                    else{
                        echo "";
                    }
                }
            }
        }

        if ($_POST['voertuigen'] == 2){
            while ($data_show = mysqli_fetch_assoc($results_show)){
                if ($data_show['auto_status_reservering'] == 0) {
                    if ($data_show['auto_soort'] == 1 && $data_show['auto_status'] == 0){
                        ?>
                        <div class='card-group '>
                            <div class="card shadow-lg rounded">
                                <img height="50%" class='card-img-top' src='image/<?php echo $data_show['auto_img'] ?>'>
                                <div class="card-body bg-light">
                                    <a class="text-secondary shadow-lg rounded" href="./pages/voertuig_view.php?view=<?php echo $data_show['id_auto']
                                    ?>&start_datum=<?php echo $start_datum?>&eind_datum=<?php echo $eind_datum?>">
                                        <h5 class="card-title text-dark"><?php echo $data_show['auto_model_merk'] . " " . $data_show['auto_model_model'] ?></h5>
                                    </a>
                                    <p class="card-text text-secondary" ><?php echo $data_show['auto_info']?></p>
                                </div>
                            </div>
                        </div>
                        <?php if($i % 3 === 0) echo "</div><div class='row row-cols-1 row-cols-md-3 g-4 m-2'>"; ?>
                        <?php $i++; ?>
                        <?php
                    }
                    else{
                        echo "";
                    }
                }
            }
        }

    }

}
