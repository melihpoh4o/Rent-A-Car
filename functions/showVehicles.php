<?php
//show more expensive Vehicles
function showVehicles($conn){
    $query = "SELECT * 
                  FROM auto
                  JOIN auto_model 
                  ON auto.id_auto_model = auto_model.id_auto_model";
    $results = mysqli_query($conn,$query);
    $i = 1;
    while($data = mysqli_fetch_array($results)){
        if ($data['auto_status'] == 0){
            if ($data['auto_model_prijs_per_dag'] >= 80 ){
                ?>
                <div class='card-group '>
                    <div class="card shadow-lg rounded">
                        <img height="60%" class='card-img-top' src='image/<?php echo $data['auto_img'] ?>'>
                        <div class="card-body bg-light">
                            <h5 class="card-title text-dark"><?php echo $data['auto_model_merk'] . " " . $data['auto_model_model'] ?></h5>
                            <p class="card-text text-secondary" ><?php echo $data['auto_info']?></p>
                        </div>
                    </div>
                </div>
                <?php if($i % 3 === 0) echo "</div><div class='row row-cols-1 row-cols-md-3 g-4 m-4'>"; ?>
                <?php if ($i >= 9) break; ?>
                <?php $i++; ?>
                <?php
            }
        }
    }
}
