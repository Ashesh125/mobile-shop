<?php
    include "configuration.php";

    $sql_fetchCatagories = "SELECT * FROM tbl_catagories";
    $result_fetchCatagories = mysqli_query($conn, $sql_fetchCatagories);

    if (mysqli_num_rows($result_fetchCatagories) > 0) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result_fetchCatagories)) {
        
          $catagories[$i] = Array(
              'id' => $row['cat_id'],
              'name' => $row['cat_name']
          );
          $i++;
        }
    }
 
?>