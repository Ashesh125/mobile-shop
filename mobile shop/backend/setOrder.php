<?php
    include 'configuration.php';

    if($_GET){
        $location = $_GET['location'];
        $date = $_GET['date'];
        $price = $_GET['price'];
        $p_id = $_GET['p_id'];
        $c_id = $_GET['c_id'];
        $bill_no = $_GET['bill'];

        $sql_search = "SElECT bill_no from tbl_orders where bill_no = $bill_no";
        $result = mysqli_query($conn,$sql_search);
        if (mysqli_num_rows($result) > 0) {
           echo "error"; 
                   
        }else{
            $sql = "INSERT INTO tbl_orders (c_id, p_id, order_date, o_price, location, status) VALUES ('$c_id', '$p_id', '$date', '$price', '$location', 0)";
            if(mysqli_query($conn,$sql)){
                $sql_update = "UPDATE tbl_count set count_no=count_no+1 where count_type='Orders Pending'";
                mysqli_query($conn,$sql_update);
                header("location:http://localhost/mobile%20shop/index.php");
            }else{
                echo "something went wrong";
        }
        
    
    }
    mysqli_close($conn);
}
?>