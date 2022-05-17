<?php 
    include 'configuration.php';
    include 'dashboard.php';

    $fetch_billno = "SELECT bill_no FROM tbl_orders where status='1' group by bill_no desc";

    $result = mysqli_query($conn, $fetch_billno);

    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
            
            $bills[$i] = array($row['bill_no']);
            $i++;
        }
       //print_r($bills)  ; echo "<br>";    
    }
    
    for($i=0;$i<sizeof($bills);$i++){
        $sql_customerinfo = "SELECT DISTINCT c_name,c_phone FROM `tbl_customers`,tbl_orders WHERE tbl_customers.c_id = tbl_orders.c_id && tbl_orders.bill_no = ".$bills[$i][0];
        $sql_orderbill = "SELECT * from tbl_orders where bill_no = ".$bills[$i][0];
        
        $orderResult = mysqli_query($conn, $sql_orderbill);
        $orderCustomer = mysqli_query($conn, $sql_customerinfo);

        if (mysqli_num_rows($orderResult) > 0) {
           
            $rowC = mysqli_fetch_assoc($orderCustomer);
            while($row = mysqli_fetch_assoc($orderResult)) {
              $orders[$i] = Array(
                  "o_id" => $row['o_id'],
                  "p_id" => $row['p_id'],
                  'c_name' => $rowC['c_name'],
                  'c_phone' => $rowC['c_phone'],
                //   'p_name' => $rowP['p_name'],
                  "c_id" => $row['c_id'],
                  "date" => $row['order_date'],
                  'billno' => $row['bill_no'],
                  'location' => $row['location'],
                    // 'qty' => $rowP['p_qty']
                );
                $sql_productinfo = "SELECT p_name,p_qty FROM `tbl_products`,tbl_orders WHERE tbl_products.p_id = tbl_orders.p_id && tbl_orders.bill_no = ".$bills[$i][0];            
                $orderProduct = mysqli_query($conn, $sql_productinfo);  
                // echo $sql_productinfo."<br>";
                $products = array();
                if (mysqli_num_rows($orderProduct) > 0) {
                    $j = 0;
                while($rowP = mysqli_fetch_assoc($orderProduct)) {
                    $products[$j] = Array(
                        'p_name' => $rowP['p_name'],
                          'qty' => $rowP['p_qty']
                      );
                      $j++;
                    }
                    $sql = "SELECT o_price,o_qty FROM tbl_orders WHERE bill_no = ".$bills[$i][0];            
                    $orderResult = mysqli_query($conn, $sql);  
                   
                    $details = array();
                    if (mysqli_num_rows($orderResult) > 0) {
                        $m = 0;
                    while($row = mysqli_fetch_assoc($orderResult)) {
                        $details[$m] = Array(
                              "qty" => $row['o_qty'],
                              "o_price" => $row['o_price'],
                          );
                          $m++;
                        }
    
                    
                

                $customerInfo[$i]=$orders[$i];
                    array_push($customerInfo[$i],$products);
                
                    array_push($customerInfo[$i],$details);    
                }

            }
        }
          }
    }
     
    // print_r($customerInfo[2]);
    mysqli_close($conn);


?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <div id="main_content">
    <?php foreach($customerInfo as $k => $info){?>
   
    <table id="ordersTable" class="ordersTable">
    <caption style="left: 300px;">
        <div style="text-align:left;padding:5px;">
            <h3>Bill no : <?=$info["billno"]?></h3>
            Customer : <?=$info["c_name"]?><br>
            Phone : <?=$info["c_phone"]?><br />
            Date : <?=$info["date"]?><br />
            Location : <?=$info['location']?><br/>
        </div>

        <!-- $customerInfo[0][0][0]['p_name'] -->
    <!--    _______________  has all details of a particular bill no ,[0] => bill 0 , [1] => bill 1 
            __________________ 0 => product(qty and name), 1=> order(qty and price) 
            ______________________ contains product names and quantities , bill 0 ko product [0] ra product qty [0]
            _________________________________ last ko ['p_name'] => product name and ['qty'] => product quantity 

         -->
    
    </caption>
        <tr>
            <th>S.N.</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price (Rs)</th>
        </tr>
        <?php foreach($customerInfo[$k][0] as $p => $product){ ?>
        <tr>
            <td><?=$p+1?></td>
            <td><?=$product["p_name"]?></td>
            <td><?=$customerInfo[$k][1][$p]["qty"]?></td>
            <td><?=$customerInfo[$k][1][$p]["o_price"]?></td>
            
        </tr>
        <?php } ?>
    </table>
    <?php }?>
    </div>
    </body>
    <style>
        #ordersP{
            background-color: lavender;
        }

        .ordersTable{
        position: relative;
        }
    </style>

</html>