<?php
    include 'index_body/header.php';
    include "backend/configuration.php";
    
    if($_GET){
        $cat_id = $_GET['cat_id'];
        $sql = "SELECT * from tbl_products natural join tbl_descriptions WHERE cat_id = '$cat_id'";
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while($row = mysqli_fetch_assoc($result)) {
        
                $products[$i] = Array(
                    'p_id' => $row['p_id'],
                    'name' => $row['p_name'],
                    'price' => $row['p_price'],
                    'discount' => $row['discount'],
                    // 'qty' => $row['p_qty'],
                    'img_name' => $row['img_name'],
                    // 'processor' => $row['processor'],
                    // 'graphics' => $row['graphics'],
                    // 'ram' => $row['RAM'],
                    // 'storage' => $row['storage'],
                    // 'display' => $row['display'],
                    // 'color' => $row['color'],
                    // 'battery' => $row['battery']
                );
                $i++;
            } 
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

    
    <section class="service container py-5">
        <h1 class="mb-0 mb-md-3">Products</h1>
        <div class="row">
            <?php foreach($products as $index => $product){ ?>
                
            <div class="col-12 col-md-4 mt-4 mt-md-0">
                
                <div class="card">
                    <img class="card-img-top" src="image/product-images/<?=$product['img_name']?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="http://localhost/mobile%20shop/product.php?p_id=<?=$product['p_id']?>&cat_id=<?=$cat_id?>"><?=$product['name']?></a>
                        </h5>
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
                        
                        <div class="mt-3">
                            <button class="btn btn-primary btn-block" onclick="location.href='http://localhost/mobile%20shop/product.php?p_id=<?=$product['p_id']?>&cat_id=<?=$cat_id?>'">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
      
        </div>
    </section>
</body>

</html>
<?php
    include 'index_body/footer.php';
?>