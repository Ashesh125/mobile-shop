<?php
    include "configuration.php";
   
    if($_GET){
        $id = $_GET['c_id'];
        $sql = "DELETE FROM tbl_customers WHERE c_id = $id";
        
        if(mysqli_query($conn, $sql)){
            $sql_update = "UPDATE tbl_count set count_no = count_no - 1 where count_type = 'Logged In Users'";
            mysqli_query($conn,$sql_update);
            
            header('Location:http://localhost/mobile%20shop/backend/fetchCustomerInfo.php');
            // exit();
        }
    }
    mysqli_close($conn);
?>