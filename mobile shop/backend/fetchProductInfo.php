<?php
    include "dashboard.php";
    include 'fetchProductInfo(C).php';

    if(isset($_SESSION['errorCannotDelete'])){	
	if($_SESSION['errorCannotDelete']==true){
            echo "<script>alert('The current product is affiliated in one or more orders {pending or completed} so the product cannot be DELETED !');</script>"; 
            $_SESSION['errorCannotDelete'] = false;
        }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>
    </title>
    <script src="https://kit.fontawesome.com/552433a799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dashboard.css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"> -->
    
  </head>
  <body>

    <div id="main_content">
    <?php 
        $i =0;
        foreach($all as $key => $products ){?>
        
     <div id='productType' style="margin-top:15px;"><?=$catagories[$i++]['cat_name']?></div>   
    <table class="productsTable">
        <tr>
            <th class="smol">S.N.</th>
            <th>Name</th>
            <th>Price (Rs)</th>
            <th>Discount (%)</th>
            <th>Quantity</th>
            <th>Img Name</th>
            <th class="smol">+</th>
            <th class="smol">Update</th>
            <th class="smol">Delete</th>
        </tr>
        <?php foreach($products as $index => $product){ ?>
        <tr>
            <td><?=$index+1?></td>
            <td><?=$product['name']?></td>
            <td><?=$product["price"]?></td>
            <td><?=$product["discount"]?></td>
            <td><?=$product["qty"]?></td>
            <td><?=$product["img_name"]?></td>
            <td><button class="additional-info" onclick="move(<?=$product['id']?>,<?=$product['cat_id']?>)">+</button></td>
            <td>
                <a class="ud" id="update" href="http://localhost/mobile%20shop/backend/updateProductInfo.php?p_id=<?=$product['id']?>"><i class="fas fa-cloud-upload-alt" id="updateBtn"></i></a>
            </td>
            <td>   
                <a class="ud" id="delete" href="http://localhost/mobile%20shop/backend/deleteProductInfo.php?p_id=<?=$product['id']?>" onclick="return confirm('Confirm Deletion ???');"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php }?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </body>
  <script>   
    //$(document).ready(function(){
        function move(id,catId){
            // alert(id);
            let url = "http://localhost/mobile%20shop/backend/showDetailedProductInfo.php?p_id="+id+"&cat_id="+catId;
            window.open(url);
        }
    //});
  </script>
    <style>
       #products{
      background-color: lavender;
    }
    #addProducts{
        background-color: rgba(252, 252, 252, 0.548);
    }
    .productsTable{
        position: relative;
    }
    th{
        position: relative;
    }
    </style>
</html>