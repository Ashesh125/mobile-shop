<?php
    include 'configuration.php';
header('Content-Type: application/json');


       $sqlQuery = "SELECT p_name,p_qty FROM tbl_products order by cat_id";
   
       $result = mysqli_query($conn,$sqlQuery);
   
       $data = array();
       foreach ($result as $row) {
           $data[] = $row;
       }
   
       mysqli_close($conn);
   
       echo json_encode($data);
       
   

?>