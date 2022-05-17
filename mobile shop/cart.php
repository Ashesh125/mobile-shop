<?php
    include 'index_body/header.php';
    include 'backend/configuration.php';

    if(!isset($_SESSION['user'])){
        echo "
            <script>
                location.href = 'index.php';
            </script>
        
        ";
    }


    if(!isset($_SESSION['product_id'])){
        $_SESSION['product_id'] = Array();
        $_SESSION['no_of_items'] = Array();
    }else{
        
        $_SESSION['no_of_items'] = array_values(array_filter($_SESSION['no_of_items']));
        $_SESSION['product_id'] = array_values(array_filter($_SESSION['product_id']));
    }
    if($_GET){
        
    if(!in_array($_GET['pid'],$_SESSION['product_id'])){
        array_push($_SESSION['product_id'],$_GET['pid']);
        array_push($_SESSION['no_of_items'],1);
    }
    }
        
    // print_r($_SESSION["product_id"]);
    $products = Array();
    $ggTotal = 0;
    foreach($_SESSION['product_id'] as $index => $ids){
        $sql = "SELECT p_id,p_name,p_price,discount,img_name,cat_id fROM tbl_products where p_id=\"$ids\"";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            $j = 0;
            while($row = mysqli_fetch_assoc($result)) {
            
                $product = Array(
                'id' => $row['p_id'],
                'name' => $row['p_name'],
                'price' => $row['p_price'],
                'discount' => $row['discount'],
                'img_name' => $row['img_name'],
                'catId' => $row['cat_id']
            );
            $j++;
            }
        
        } 
        array_push($products,$product);
    }
    // print_r($_SESSION['product_id']);
?>

<!DOCTYPE HTML>
<html>
    <head>
    
       
    </head>
    <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
        <?php 
            foreach($products as $index => $product){
        ?>
        <div class="container shadow my-5 " >
            
                <caption><?=$index+1?> )     <a href="http://localhost/mobile%20shop/product.php?p_id=<?=$product['id']?>&cat_id=<?=$product["catId"]?>"><?=$product['name']?></a>
                        </caption>
                
                <div class="row text-dark border-dark" style="background-color:lightblue;">
                    <div class="col-4">
                        <img src="./image/product-images/<?=$product['img_name']?>"  style="width: 200px;height:200px;">
                    </div>
                    <div class="col-2 align-self-center px-5">
                        Quantity :
                        <select name="qty" class="qty" id="<?=$index?>">
                            <?php for($j=1;$j<=30;$j++){?>
                                <option value="<?=$j?>" <?php if($_SESSION['no_of_items'][$index] == $j){echo "selected";}?>><?=$j?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-2 align-self-center">
                        <?php
                        if($product['discount'] > 0){
                            $dis = $product['discount'];
                            $priceorg = $product['price'];
                            $price = $priceorg-($priceorg*$dis)/100;
                            echo "
                                <span>Price<br>Rs <s>$priceorg</s></span>
                                <span class='price'> $price ($dis%)</span>
                            ";
                        }else{
                            $price = $product['price'];
                            echo "
                                <span>Price<br> Rs $price</span>
                            ";
                        }
                    ?>
                        
                    </div>
                    <div class="col-2 align-self-center">
                        Total 
                        <br>Rs
                            <?php 
                                $gTotal = $_SESSION["no_of_items"][$index]*$price;
                                $ggTotal = $ggTotal+$gTotal; 
                                echo $gTotal;
                            ?>

                        
                    </div>
                    <div class="col-2 align-self-center">
                        <a href="deleteCart.php?id=<?=$index?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                </div>
        </div>

        <?php }?>
        <div class="container my-5">
            <div class="row">
            <div class="col-2">
                <span>Grand Total </span>
            </div>
            <div class="col-2">
                <span> Rs <?php echo $ggTotal; ?> </span>
                <span class="deliveryPrice" style="display: none;">  </span>
            </div>
            </div>

            <div class="container">
                                <label for="exampleFormControlSelect1">Select Location</label>
                                
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option value="0" selected>Basundhara</option>
            
                                    <option value="40">Putalishadak</option>
                                    <option value="50">Chabhill</option>
                                    <option value="50">Samakhusi</option>
                                    <option value="60">Gangaboo</option>
                                    <option value="80">Kapan</option>
                                    <option value="50">Boudha</option>
                                    <option value="50">Swyambu</option>
                                    <option value="40">Kalanki</option>
                                    <option value="30">Banasthali</option>
                                    <option value="50">Budanilkantha</option>
                                    <option value="50">Chandragiri</option>
                                    <option value="50">Dakshinkali</option>
                                    <option value="50">Gokarneshwar</option>
                                    <option value="50">Kageshwari Manohara</option>
                                    <option value="100">Kirtipur</option>
                                    <option value="50">Nagarjun</option>
                                    <option value="50">Shankharapur </option>   
                                    <option value="50">Tinkunye</option>     
                                    <option value="50">Koteshwor </option>     
                                    <option value="50">Sinamangal</option>     
                                    <option value="50">Shankharapur </option>     
                                    <option value="50">Patan</option>  
                                    <option value="40">Kupandol</option> 
                                    <option value="50">Satdobato</option> 
                                    <option value="50">Jadibuti</option>     
                                    <option value="50">Tokha</option>
                                    <option value="50">Tarakeshwar</option>
                      </select>
                            </div>
   
                <button type="button" class="btn btn-success" data-target="#exampleModalCenter" id="buynow">
                            Buy Now 
                        </button>
        </div>

        <div class="container">
            <div class="d-flex aligns-items-center justify-content-center">
        <div id="paypal-button-container"></div>
        </div>    
    </div>
        <script
    src="https://www.paypal.com/sdk/js?client-id=AVUFRjqlbQ2z2scwlkVmBKMDyMn5vOt-IBwpdMRs_M8CjDPpAwPyVqyKYmc84k2Hn_fKL5OvFgurSeTf"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
  </script>   
  
  <script>
      var location1;
      var selectedText;
      var money = (parseInt("<?=$ggTotal?>")+parseInt(location1))/100;
      $("#exampleFormControlSelect1").change(function(){
            location1 = $('#exampleFormControlSelect1').val();
  
            // alert (location);
            //Get text or inner html of the selected options
            selectedText = $("#exampleFormControlSelect1 option:selected").html();
            // alert(selectedText);
            money = (parseInt("<?=$ggTotal?>")+parseInt(location1))/100;
            alert(money);
    
    
        });
        $("#buynow").click(function(){
            location1 = $('#exampleFormControlSelect1').val();
  
            selectedText = $("#exampleFormControlSelect1 option:selected").html();
            
            money = (parseInt("<?=$ggTotal?>")+parseInt(location1))/100;
            url = "./backend/setOrder.php?location="+location1+"&name="+selectedText;
            // alert(url);
            window.location.href = url;
        });
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
    //   var money =  + location;
    //   money = money/102;
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: money
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {

        //ata halne ajax 
        location1 = $('#exampleFormControlSelect1').val();
        
        selectedText = $("#exampleFormControlSelect1 option:selected").html();
        $.ajax({
            url:"backend/setOrder.php",
            method:"POST",
            data:{location:location1,name:selectedText},
            dataType:"json",
            success:function(response) {
                location.window.href = "deleteCart.php";
            }
        });


        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
  //This function displays Smart Payment Buttons on your web page.

  $(document).ready(function(){
            $("#exampleFormControlSelect1").change(function(){
                let selectedValue = $(this).val();
                $(".deliveryPrice").append("");
                $(".deliveryPrice").show();
                $(".deliveryPrice").text("+"+selectedValue);
            });

            $(".qty").change(function(){
                let selectedValue = $(this).val();
                let selectedId = this.id;
                $.ajax({
                    url:"cartupdate.php",
                    method:"POST",
                    data:{qty:selectedValue,id:selectedId},
                    dataType:"json"
                });
                location.reload();
            });
        });
</script>  
   
     </body>
</html>

<?php
    include 'index_body/footer.php';
?>