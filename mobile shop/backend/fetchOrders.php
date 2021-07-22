<?php 
    include 'configuration.php';
    include 'dashboard.php';

    $fetch_billno = "SELECT bill_no FROM tbl_orders where status=0";

    $result = mysqli_query($conn, $fetch_billno);

    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
            
            $bills[$i] = $row['bill_no'];
            $i++;
        }
       //print_r($bills)  ; echo "<br>";    
    }
    
    for($i=0;$i<sizeof($bills);$i++){
        $sql_customerinfo = "SELECT DISTINCT c_name,c_phone FROM `tbl_customers`,tbl_orders WHERE tbl_customers.c_id = tbl_orders.c_id && tbl_orders.bill_no = $bills[$i]";
        $sql_productinfo = "SELECT p_name,p_qty FROM `tbl_products`,tbl_orders WHERE tbl_products.p_id = tbl_orders.p_id && tbl_orders.bill_no = $bills[$i]";
        $sql_orderbill = "SELECT * from tbl_orders where bill_no = $bills[$i]";
        
        $orderProduct = mysqli_query($conn, $sql_productinfo);  
        $orderResult = mysqli_query($conn, $sql_orderbill);
        $orderCustomer = mysqli_query($conn, $sql_customerinfo);

        if (mysqli_num_rows($orderResult) > 0) {
           
            $rowC = mysqli_fetch_assoc($orderCustomer);
            $rowP = mysqli_fetch_assoc($orderProduct);
            while($row = mysqli_fetch_assoc($orderResult)) {
              $orders[$i] = Array(
                  "p_id" => $row['p_id'],
                  'c_name' => $rowC['c_name'],
                  'c_phone' => $rowC['c_phone'],
                  'p_name' => $rowP['p_name'],
                  "c_id" => $row['c_id'],
                  "o_price" => $row['o_price'],
                  "date" => $row['order_date'],
                  'billno' => $row['bill_no'],
                  'location' => $row['location'],
                    'qty' => $rowP['p_qty']
                );
                
            }
          }
    }
     
    mysqli_close($conn);


?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div id="main_content">
    <table id="ordersTable">
        <tr>
            <th class="smol">S.N.</th>
            <th>Bill Number</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Location</th>
            <th>Product</th>
            <th>Price (Rs)</th>
            <th class="smol">Available</th>
            <th class="smol">Complete</th>
            <th class="smol">Delete</th>
        </tr>
        <?php foreach($orders as $index => $order){ ?>
        <tr>
            <td><?=$index+1?></td>
            <td><?=$order["billno"]?></td>
            <td><?=$order["c_name"]?></td>
            <td><?=$order["c_phone"]?></td>
            <td><?=$order["date"]?></td>
            <td><?=$order["location"]?></td>
            <td><?=$order["p_name"]?></td>
            <td><?=$order["o_price"]?></td>
            <td>
                <?php
                    if($order['qty'] <= 0){
                        echo "
                            <a class='ud2' id='available' style='color:red;'><i class='fas fa-check-circle'></i></a>
                        ";
                    }else{
                        echo "
                            <a class='ud2' id='available' style='color:darkgreen;'><i class='fas fa-check-circle'></i></a>
                        ";
                    }
                    
                ?>
            </td>
            <td>   
              <a class="ud" id="complete" href="http://localhost/mobile%20shop/backend/completeOrder.php?id=<?=$order['billno']?>&pid=<?=$order['p_id']?>" onclick="return confirm('Comfirm Order Completion ?')"><i class="fa fa-close"></i></a>
            </td>  
            <td>   
              <a class="ud" id="delete" href="http://localhost/mobile%20shop/backend/deleteOrder.php?id=<?=$order['billno']?>&pid=<?=$order['p_id']?>" onclick="return confirm('Comfirm Order Deleteion ?')"><i class="fa fa-close"></i></a>
            </td> 
        </tr>
        <?php } ?>
    </table>
    
    </div>
    </body>
    <style>
        #ordersP{
            background-color: lavender;
        }
    </style>

</html>