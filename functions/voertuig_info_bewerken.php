<?php

function voertuig_info_bewerken($conn){

    $get_id = $_GET['edit'];


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['opslaan'])){

            //delete previous image
            $_query_image = "SELECT * FROM auto WHERE id_auto_model = '$get_id'";
            $results_image = mysqli_query($conn,$_query_image);
            $user_data = mysqli_fetch_assoc($results_image);
            unlink("../image/".$user_data['auto_img']);

            $auto_img = $_FILES["uploadfile"]["name"];
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $folder = "../image/".$auto_img;


            $auto_model_merk = $_POST['auto_model_merk'];
            $auto_model_model = $_POST['auto_model_model'];
            $auto_kenteken = $_POST['auto_kenteken'];
            $auto_model_bouwjaar = $_POST['auto_model_bouwjaar'];
            $auto_soort = $_POST['auto_soort'];
            $auto_status = $_POST['auto_status'];
            $auto_info = $_POST['auto_info'];
            $auto_model_kilometerstand = $_POST['auto_model_kilometerstand'];
            $auto_model_prijs_per_dag = $_POST['auto_model_prijs_per_dag'];


            $query_update = "UPDATE auto
                             JOIN auto_model
                             ON auto.id_auto_model = auto_model.id_auto_model
                             SET auto_model_merk = '$auto_model_merk',
                                 auto_model_model = '$auto_model_model',
                                 auto_kenteken = '$auto_kenteken',
                                 auto_model_bouwjaar = '$auto_model_bouwjaar',
                                 auto_soort = '$auto_soort',
                                 auto_status = '$auto_status',
                                 auto_info = '$auto_info',
                                 auto_model_kilometerstand = '$auto_model_kilometerstand',
                                 auto_model_prijs_per_dag = '$auto_model_prijs_per_dag',
                                 auto_img = '$auto_img'
                             WHERE auto.id_auto_model = '$get_id'";


            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($tempname, $folder))  {
                $msg = "Image uploaded successfully";
            }else{
                $msg = "Failed to upload image";
            }

            mysqli_query($conn,$query_update);
            header("Location: ../pages/voertuig_bewerken.php?edit=$get_id");

        }
    }

    if (isset($_POST['delete'])) {
        //delete previous image
        $query_delete = "SELECT * FROM auto WHERE id_auto_model = '$get_id'";
        $results_delete = mysqli_query($conn, $query_delete);
        $user_data = mysqli_fetch_assoc($results_delete);
        unlink("../image/" . $user_data['auto_img']);

        $query_update = "DELETE auto
                         FROM auto_model
                         JOIN ON auto.id_auto_model = auto_model.id_auto_model
                         WHERE auto.id_auto_model = '$get_id'";

        mysqli_query($conn, $query_delete);
        header("Location: ../pages/voertuigen.php");
    }

    //get table data to use in another page
    $query = "SELECT *
	      FROM auto
	      JOIN auto_model ON auto.id_auto_model = auto_model.id_auto_model
          WHERE auto.id_auto_model = '$get_id'";

    $results = mysqli_query($conn, $query);

    if ($results && mysqli_num_rows($results) > 0){
        $user_data = mysqli_fetch_assoc($results);
        return $user_data;
    }



}