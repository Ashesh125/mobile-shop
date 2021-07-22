<?php
    session_start();
    include 'configuration.php';

    if($_GET){
        $id = $_GET['id'];
        $pid = $_GET['pid'];

        $sql_update2 = "UPDATE tbl_count set count_no = count_no - 1 where count_type = 'Orders Pending'";
        $sql_update3 = "UPDATE tbl_count set count_no = count_no + 1 where count_type = 'Orders completed'";
        mysqli_query($conn,$sql_update2);
        mysqli_query($conn,$sql_update3);
        $sql_update = "UPDATE tbl_products set p_qty = p_qty-1 where p_id = $pid and p_qty > 0";
        mysqli_query($conn,$sql_update);
        

        $sql_complete = "UPDATE tbl_orders set status = 1 where bill_no=$id and status = 0";
        if(mysqli_query($conn,$sql_complete)){
            header('location:http://localhost/mobile%20shop/backend/fetchCompletedOrders.php');
        } else{
            echo $sql_complete;
        }
    }
    

?>