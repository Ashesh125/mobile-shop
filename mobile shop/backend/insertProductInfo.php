<?php 
include "configuration.php";

 
if($_POST){
    $mode = $_GET['mode'];
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $qty = $_POST['qty'];
    $cat_id = $_POST['cat_id'];
    $img_name = $_POST['img_name'];
    // echo $mode;
    $processor = $_POST['processor'];
    $graphics = $_POST['graphics'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $display = $_POST['display'];
    $colors = $_POST['color'];
    $battery = $_POST['battery'];
    if($mode == 0){
        $sql = "INSERT INTO tbl_products (p_name, p_price, discount, p_qty, cat_id, img_name) values 
        ('$pname','$price', '$discount' ,'$qty','$cat_id','$img_name')";

        if(mysqli_query($conn,$sql)){
            echo "ok";
        }else{
            echo "<script>alert('Error!!!')</script>";  
            header('Location:http://localhost/mobile%20shop/backend/productFrom.php');
        }

        $getProductIdSQL = "SELECT max(p_id) as pid FROM tbl_products";
        $pId = mysqli_query($conn,$getProductIdSQL);

        $row = mysqli_fetch_assoc($pId);
        $pID = $row['pid'];

        //echo "pID = ".$pID;
        $sql2 = "INSERT INTO tbl_descriptions (p_id,processor,graphics,RAM,storage,display,color,battery) VALUES ('$pID','$processor','$graphics','$ram','$storage','$display','$colors','$battery')";

        // echo $mode;
        if(mysqli_query($conn,$sql2)){
            header('Location:http://localhost/mobile%20shop/backend/fetchProductInfo.php');
        }

    }else{
        $Pid = $_POST['p_id'];
        $sql = "UPDATE tbl_products set p_name='$pname',p_price = '$price',discount='$discount',p_qty='$qty',cat_id='$cat_id',
               img_name ='$img_name' where p_id = $Pid";
        mysqli_query($conn,$sql);
        $sql = "UPDATE tbl_descriptions set processor = '$processor', graphics='$graphics',RAM ='$ram',storage='$storage',display='$display',
            color='$colors',battery='$battery' where p_id =$Pid";
        mysqli_query($conn,$sql);
       header('Location:http://localhost/mobile%20shop/backend/fetchProductInfo.php');
    }

    
}
else{
    echo "<script>alert('Error!!!')</script>";  
    header('Location:http://localhost/mobile%20shop/backend/productFrom.php');
}

mysqli_close($conn);




?>