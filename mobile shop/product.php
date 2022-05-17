<?php 
    include 'index_body/header.php';
    include 'backend/configuration.php';

    if($_GET){
        $p_id = $_GET['p_id'];
        $cat_id = $_GET['cat_id'];
        if($cat_id > 2){
            $show = 'hide';
        }else{
            $show = 'show';
        }
        $sql = "SELECT * from tbl_products natural join tbl_descriptions WHERE p_id = $p_id";

        $result = mysqli_query($conn,$sql);
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            
        $row = mysqli_fetch_assoc($result);
        
            $product = Array(
                'id' => $row['p_id'],
                'name' => $row['p_name'],
                'price' => $row['p_price'],
                'discount' => $row['discount'],
                'qty' => $row['p_qty'],
                'img_name' => $row['img_name'],
                'processor' => $row['processor'],
                'graphics' => $row['graphics'],
                'ram' => $row['RAM'],
                'storage' => $row['storage'],
                'display' => $row['display'],
                'color' => $row['color'],
                'battery' => $row['battery']
            );
            
        }
        
   
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>mobile shop</title>
    <link rel="shortcut icon" href="image/favicon.ico" type="image/png" />
</head>

<body>
    <div class="overlay"></div>

    <section class="container product pt-5" style="min-height: 80vh;">
        <div class="row">
            <div class="col">
                <img class="card-img-top" src="image/product-images/<?=$product['img_name']?>" alt="images/devices.svg" style="width:80%;" alt="Card image cap">
            </div>
            <div class="col">
                <div>
                    <h2 class="card-title">
                        <?=$product['name']?>
                    </h2>
                    <p>
                    <?php
                            
                            if($product['discount'] > 0){
                                $dis = $product['discount'];
                                $priceorg = $product['price'];
                                $price = $priceorg-($priceorg*$dis)/100;
                                echo "
                                    <span>Rs <s>$priceorg</s></span>
                                    <span class='price'> $price ($dis%)</span>
                                ";
                            }else{
                                $priceorg = $product['price'];
                                echo "
                                    <span>Rs $priceorg</span>
                                ";
                            }
                        ?>
                    </p>
                    <div>
                       
                    <button type="button" data-toggle='modal' class="btn btn-success" data-target="#exampleModalCenter" id="addCart"
                            <?php 
                                if(isset($_SESSION['user'])){
                                    echo "onclick='addCart(".$product['id'].");'";
                                }else{ 
                                    echo "onclick='plsLogin();'";
                                }
                            ?> 
                        >                    
                        <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>

                    <div class="list mt-3" id="<?=$show?>">
                        <div class="d-flex">
                            <span><i class="fas fa-microchip"></i></span>
                            <span> <?=$product['processor']?></span>
                        </div>
                        <?php 
                            $temp =$product['graphics'];
                                
                            if($cat_id == 1){
                                echo "
                                    <div class='d-flex'>
                                    <span><i class='fas fa-microchip'></i></span>
                                    <span>$temp</span>
                                    </div>
                                ";
                            }else{
                                echo "
                                    <div class='d-flex'>
                                    <span><i class='fas fa-camera'></i></span>
                                    <span>$temp</span>
                                    </div>
                                ";
                            }
                        ?>
                        <div class="d-flex">
                            <span><i class="fas fa-microchip"></i></span>
                            <span><?=$product['ram']?> RAM </span>
                        </div>
                        <div class="d-flex">
                            <span><i class="fas fa-compact-disc"></i></span>
                            <span><?=$product['storage']?> Storage</span>
                        </div>
                        <div class="d-flex">
                            <span><i class="fas fa-laptop"></i></span>
                            <span><?=$product['display']?> Display</span>
                        </div>
                        <?php
                                if($cat_id == 2){
                                    $temp2 = $product['battery'];
                                    echo "
                                        <div class='d-flex'>
                                        <span><i class='fas fa-battery-full'></i></span>
                                        <span>$temp2 mAh Battery</span>
                                        </div>
                                    ";
                                }
                        ?>
                        
                    </div>

                    <div class="d-flex mt-3">
                        <span class="mr-2">Colors: </span>
                        <?php $color_arr = explode(",",$product['color']); 
                            for($i = 0;$i<sizeof($color_arr);$i++){
                                echo "<span class='circle'><i class='fa fa-circle' style='color:".$color_arr[$i].";''></i></span>";    
                            }?>                    
                    </div>
                </div>
            </div>
        </div>



    </section>
</body>
<script>
    function plsLogin() {
        let choice = confirm('Please Create an account or log in to an existing account to Place an order');
        
        if (choice == true) {
            window.location.href = "http://localhost/mobile%20shop/login.php";
            
        }
    }
    function addCart(pid){
        window.location.href = "http://localhost/mobile%20shop/cart.php?pid="+pid;
    }
    
</script>
<style>
    #hide{
        display: none;  
    }
</style>

</html>
<?php
    include 'index_body/footer.php';
?>