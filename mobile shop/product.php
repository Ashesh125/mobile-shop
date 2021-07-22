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
                        <button type="button" class="btn btn-success" data-target="#exampleModalCenter" id="buynow"
                            <?php 
                                if(isset($_SESSION['user'])){
                                    echo "data-toggle='modal'";
                                }else{
                                    echo "onclick='plsLogin()'";
                                }
                            ?> 
                        >
                        Buy Now
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


        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Fill in the Following Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Location</label>
                                
                                <select class="form-control" id="exampleFormControlSelect1">
                        <option value="40,Putalishadak">Putalishadak</option>
                        <option value="50,Chabhill">Chabhill</option>
                        <option value="50,Samakhusi">Samakhusi</option>
                        <option value="60,Gangaboo">Gangaboo</option>
                        <option value="80,Kapan">Kapan</option>
                        <option value="0,Basundhara",>Basundhara</option>
                        <option value="50,Boudha">Boudha</option>
                        <option value="50,Swyambu">Swyambu</option>
                        <option value="40,Kalanki">Kalanki</option>
                        <option value="30,Banasthali">Banasthali</option>
                        <option value="50,Budanilkantha">Budanilkantha</option>
                        <option value="50,Chandragiri">Chandragiri</option>
                        <option value="50,Dakshinkali">Dakshinkali</option>
                        <option value="50,Gokarneshwar">Gokarneshwar</option>
                        <option value="50,Kageshwari Manohara">Kageshwari Manohara</option>
                        <option value="100,Kirtipur">Kirtipur</option>
                        <option value="50,Nagarjun">Nagarjun</option>
                        <option value="50,Shankharapur">Shankharapur </option>   
                        <option value="50,Tinkunye">Tinkunye</option>     
                        <option value="50,Koteshwor">Koteshwor </option>     
                        <option value="50,Sinamangal">Sinamangal</option>     
                        <option value="50,Shankharapur">Shankharapur </option>     
                        <option value="50,Patan">Patan</option>  
                        <option value="40,Kupandol">Kupandol</option> 
                        <option value="50,Satdobato">Satdobato</option> 
                        <option value="50,Jadibuti">Jadibuti</option>     
                        <option value="50,Tokha">Tokha</option>
                        <option value="50,Tarakeshwar">Tarakeshwar</option>
                      </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a type="button" onclick="move();" class="btn btn-success">Save</a>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
            window.location.href = "http://localhost/mobile%20shop/register.php";
        }
    }

    function move(){
        let value = document.getElementById('exampleFormControlSelect1').value;
        let url = "http://localhost/mobile%20shop/bill.php?location="+value+"&p_id=<?=$p_id?>";
        window.location.href = url;
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