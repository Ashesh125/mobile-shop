<?php
    session_start();
    include 'configuration.php';

    if($_GET){
        $id = $_GET['id'];
        $sql_update2 = "UPDATE tbl_count set count_no = count_no - 1 where count_type = 'Orders Pending'";
        $sql_update3 = "UPDATE tbl_count set count_no = count_no + 1 where count_type = 'Orders completed'";
        mysqli_query($conn,$sql_update2);
        mysqli_query($conn,$sql_update3);
            $sql = "SELECT p_id,o_qty from tbl_orders where bill_no=$id";
            $result = mysqli_query($conn,$sql);
            
            if (mysqli_num_rows($result) > 0) {
                $i=0;
                while($row = mysqli_fetch_assoc($result)) { 
                    
                    $items[$i] = array(
                        'pid' => $row['p_id'],
                        'qty' => $row['o_qty']
                    );
                    $i++;
                }
            }
            print_r($items);
        foreach($items as $index => $item){
            $temp = $item['pid'];
            $sql_update = "UPDATE tbl_products set p_qty = p_qty-".$item['qty']." where p_id = \"$temp\"";
            mysqli_query($conn,$sql_update);
        
            // echo $sql_update."<br>";
        }
        

        $sql_complete = "UPDATE tbl_orders set status = 1 where bill_no=$id and status = 0";
        if(mysqli_query($conn,$sql_complete)){
            header('location:http://localhost/mobile%20shop/backend/fetchCompletedOrders.php');
        } else{
            echo $sql_complete;
        }
    }
    

?>