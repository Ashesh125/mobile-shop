<?php 
    include 'configuration.php';
    include 'dashboard.php';
 
    $fetch_billno = "SELECT bill_no FROM tbl_orders where status=1 order by bill_no desc";

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
        $sql_productinfo = "SELECT p_name FROM `tbl_products`,tbl_orders WHERE tbl_products.p_id = tbl_orders.p_id && tbl_orders.bill_no = $bills[$i]";
        $sql_orderbill = "SELECT * from tbl_orders where bill_no = $bills[$i]";
        
        $orderProduct = mysqli_query($conn, $sql_productinfo);  
        $orderResult = mysqli_query($conn, $sql_orderbill);
        $orderCustomer = mysqli_query($conn, $sql_customerinfo);

        if (mysqli_num_rows($orderResult) > 0) {
           
            $row2 = mysqli_fetch_assoc($orderCustomer);
            $row3 = mysqli_fetch_assoc($orderProduct);
            while($row = mysqli_fetch_assoc($orderResult)) {
              $orders[$i] = Array(
                  "p_id" => $row['p_id'],
                  'c_name' => $row2['c_name'],
                  'c_phone' => $row2['c_phone'],
                  'p_name' => $row3['p_name'],
                  'o_price' => $row['o_price'],
                  "c_id" => $row['c_id'],
                  "date" => $row['order_date'],
                  'location' => $row['location'],
                  'billno' => $row['bill_no']
                );
                
            }
          }
    }
     



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
        </tr>
        <?php } ?>
    </table>
    </div>
    </body>
    <style>
        #ordersC{
            background-color: lavender;
        }

    </style>
</html>