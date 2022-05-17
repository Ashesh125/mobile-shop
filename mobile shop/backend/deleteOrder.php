<?php
    include "configuration.php";
   
    if($_GET){
        $bill_no = $_GET['id'];

        $sql = "DELETE FROM tbl_orders WHERE bill_no =$bill_no";
        
        if(mysqli_query($conn, $sql)){
            $sql_update = "UPDATE tbl_count set count_no = count_no - 1 where count_type = 'Orders Pending'";
            mysqli_query($conn,$sql_update);
            
            header('Location:http://localhost/mobile%20shop/backend/fetchOrders.php');
            // exit();
        }
    }
    mysqli_close($conn);
?>