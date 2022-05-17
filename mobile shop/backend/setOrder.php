<?php
    session_start();
    include 'configuration.php';

    if($_POST){
        $location = $_POST['location'];
        $name = $_POST['name'];
    }
    if($_GET){
        $location = $_GET['location'];
        $name = $_GET['name'];    
    }    
        $date = date("Y-m-d");

        $c_id = $_SESSION['userId'];

        $sql = "SELECT max(bill_no) as id from tbl_orders";
        $result = mysqli_query($conn,$sql);
        
        
            $row = mysqli_fetch_assoc($result);
            $bill_no = $row['id'];
            $bill_no++;
        
            for($i=0;$i<count($_SESSION['product_id']);$i++){
                $pid = $_SESSION['product_id'][$i];
                
                $qty = $_SESSION['no_of_items'][$i];
                $getprice = "SELECT p_price,discount from tbl_products where p_id = \"$pid\"";
                $row = mysqli_fetch_assoc(mysqli_query($conn,$getprice));
                $price = $row['p_price'];
                $discount = $row['discount'];
                // echo $price."<br>";
                // echo $discount."<br>";
                $price = $price - ($discount/100)*$price;
                // echo $price."<br>";
                $price = $price * $qty;
                // echo $price."<br>";
                $price += $location;
                // echo $price."<br>";
                $sql = "INSERT INTO tbl_orders (c_id, p_id, order_date, o_price, o_qty,location, status,bill_no) VALUES ('$c_id', '$pid', '$date', '$price', '$qty','$name', 0,' $bill_no')";
                if(mysqli_query($conn,$sql)){
                    echo $sql,"<br>";
                    continue;
                }else{
                    echo "something went wrong";
                }
               
            }
            
            $sql_update = "UPDATE tbl_count set count_no=count_no+1 where count_type='Orders Pending'";
            if(mysqli_query($conn,$sql_update)){
            unset($_SESSION['product_id']);
            unset($_SESSION['no_of_items']);
    
    
           
        //    header("location:http://localhost/mobile%20shop/index.php");
            }else{
                echo "count is not increase";
            }
    mysqli_close($conn);
  //      }
?>