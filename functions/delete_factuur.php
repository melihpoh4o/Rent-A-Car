<?php

function deleteFactuur($conn){
    $sql = "DELETE FROM factuur WHERE factuur_status = 0";
    $result = mysqli_query($conn,$sql);
}
