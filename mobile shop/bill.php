<?php 
	include 'index_body/header.php';
    include 'backend/configuration.php';

    if(!isset($_SESSION['user'])){
        header('Location:http://localhost/mobile%20shop/backend/logout.php');
    }
 
    if($_GET){
        $p_id = $_GET['p_id'];
        $loc = $_GET['location'];
        $location = explode(',', $loc);
        //$location[0] = delivery charge ,, location[1] = delivery location
        $sql = "SELECT * from tbl_products WHERE p_id = $p_id";

        $sql_bill = "SELECT max(bill_no) as bill FROM tbl_orders";
        $bill_result = mysqli_query($conn,$sql_bill);
        $row1 = mysqli_fetch_assoc($bill_result);
        $bill_no = $row1['bill'];
        $bill_no = $bill_no + 1; 

        $result = mysqli_query($conn,$sql);
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_assoc($result);
        
                $product = Array(
                    'id' => $row['p_id'],
                    'name' => $row['p_name'],
                    'price' => $row['p_price'],
                    'discount' => $row['discount'],
                    'img_name' => $row['img_name']
                );
            
        }
        if($product['discount'] > 0){
            $dis = $product['discount'];
            $priceorg = $product['price'];
            $amt = ($priceorg*$dis)/100;
       
        }else{
            $priceorg = $product['price'];
            $amt = 0;
        }
        $gTotal = ($product['price'] - $amt )+ $location[0] + 50; 
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
	<link rel="shortcut icon" href="image/favicon.ico"  type="image/png" />
  </head>

    <body>
	  
	    <div class="overlay"></div>
	
    <section  class="container bill pt-5" style="min-height: 80vh;">
      <div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quality</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>
                    <img class="card-img-top" src="image/product-images/<?=$product['img_name']?>" alt="Card image cap">
                    <?=$product['name']?></td>
                <td>Rs <?=$product['price']?></td>
                <td>1</td>
              </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-6"></div>
            <div class="col-6 text-right">
                <table class="table bill-table">
                    <tbody>
                        <tr>
                            <td> 
                                <span class="bill-total">Sub Total:</span> 
                            </td>
                            <td> 
                                <Span>Rs <?=$product['price']?></Span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="bill-total">Discounts:</span> 
                            </td>
                            <td>
                                <Span> 
                                    <?php
                                          if($product['discount'] > 0){
                                                echo "
                                                    <span class='price'> $amt ($dis%)</span>
                                                ";
                                        }else{
                                            echo "
                                                <span>Rs 0</span>
                                            ";
                                        }
                                    
                                    ?>
                                    
                                </Span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="bill-total">Delivery Charge:</span> 
                            </td>
                            <td>
                                <Span>
                                    <?php
                                    if($loc > 0){
                                        
                                        echo "
                                            <span>Rs 50 + $location[0]</span>
                                        ";
                                    }else{
                                        echo "
                                            <span>Rs 50</span>
                                        ";
                                    }
                                ?>
                                </Span>
                            </td>
                        </tr>
                        <tr>
                            <td> 
                                <span class="bill-total">Grand Total:</span> 
                            </td>
                            <td> 
                                <Span><?=$gTotal?></Span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"> 
                                <a type="button" href="http://localhost/mobile%20shop/paymentMethod.php?bill=<?=$bill_no?>&location=<?=$location[1]?>&price=<?=$gTotal?>&p_id=<?=$p_id?>" class="btn btn-success">Order</a> 
                            </td>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
      </div>
    </section>
    
  </body>
  
</html>
<?php
    include 'index_body/footer.php';
?>
