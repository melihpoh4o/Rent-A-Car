<?php
    //delete voertuig
    function deleteVoertuig($conn){
        $get_id = $_GET['edit'];
        if (isset($_POST['delete'])) {
            //delete previous image
            $_query_delete = "SELECT * FROM auto WHERE id_auto_model = '$get_id'";
            $results_image = mysqli_query($conn, $_query_delete);
            $user_data = mysqli_fetch_assoc($results_image);
            unlink("../image/" . $user_data['auto_img']);
            mysqli_query($conn, $_query_delete);

            $query_delete_auto = "DELETE FROM auto_model WHERE id_auto_model = '$get_id'";
            $query_delete_auto_model = "DELETE FROM auto WHERE id_auto = '$get_id'";

            if (mysqli_query($conn,$query_delete_auto)){
                mysqli_query($conn,$query_delete_auto_model);
                header("Location: ../pages/voertuigen.php");
            }
            else {
                echo "Error record: " . mysqli_error($conn);
            }

        }
    }

