<?php
    include 'configuration.php';
    include 'fetchCatagories(C).php';
    include 'dashboard.php';
    
    if($_GET){
        $id = $_GET['p_id'];

        $sql = "SELECT * FROM tbl_products INNER JOIN tbl_descriptions WHERE tbl_products.p_id = tbl_descriptions.p_id AND tbl_products.p_id = $id";
        $result = mysqli_query($conn,$sql);
        
        while($row = mysqli_fetch_assoc($result)) {
                $product = Array(
                'id' => $row['p_id'],
                'name' => htmlspecialchars($row['p_name']),
                'price' => $row['p_price'],
                'discount' => $row['discount'],
                'qty' => $row['p_qty'],
                'cat_id' => $row['cat_id'],
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/product-form.css">
</head>
<body>
    
    <div id="main-content">
        <div id="product-form-holder">
        <form id="product-form" name="product-form" method="POST" action="http://localhost/mobile%20shop/backend/insertProductInfo.php?mode=1">
            <div id="left">
            <fieldset>
                <legend>Primary Info</legend>
            <input type="hidden" value="<?=$product['id']?>" name="p_id">
            <label for="pname">Product Name</label>
            <input type="text" placeholder="Name" name="pname" value="<?=$product['name'];?>" required>
            <label for="price">Price</label>
            <input type="number" placeholder="Price (Rs)" value=<?=$product['price']?> name="price" required>
            <label for="discount">Discount</label>
            <input type="number" placeholder="Discount (%)" value=<?=$product['discount']?> name="discount" value=0>
            <label for="qty">Quantity</label>
            <input type="number" placeholder="qty" value=<?=$product['qty']?> name="qty" required>
            <label for="catagories">Catagory</label>
            <select name="cat_id" id="catagories">
                <?php foreach($catagories as $index => $catagory) {?>
                    <option value="<?=$catagory['id']?>" <?php if($catagory['id'] == $product['cat_id']){echo 'selected';}?>><?=$catagory['name']?></option>
                <?php }?>
            </select>
            <label for="img_name">Image name</label>
            <input type="text" placeholder="Image name with extension" name="img_name" value=<?=$product['img_name']?> required>
            </fieldset>    
            
            </div>
            
            
            <div id="right">
                <fieldset>
            <legend>Additional Info </legend>
            <label for="processor">Processor</label>
            <input type="text" placeholder="Processor" name="processor" value="<?=$product['processor']?>">
            <label for="graphics">Graphics/Camera</label>
            <input type="text" placeholder="Graphics/Camera" name="graphics" value="<?=$product['graphics']?>">
            <label for="ram">RAM</label>
            <input type="text" placeholder="Ram" name="ram" value="<?=$product['ram']?>">
            <label for="storage">Storage</label>
            <input type="text" placeholder="Storage" value="<?=$product['storage']?>" name="storage">
            <label for="display">Display</label>
            <input type="text" placeholder="Display" value="<?=$product['display']?>" name="display">
            <label for="color">Colors</label>
            <input type="text" placeholder="red,green" value="<?=$product['color']?>" name="color">
            <label for="battery">Battery (mAh)</label>
            <input type="number" placeholder="Battery" name="battery" value="<?=$product['battery']?>">
            
            </fieldset>  
            <input type="submit" onclick="return validateProductInfo();" value="Submit">  
            </form>
        </div>

        </div>
    
    </div>
    <script src="../js/productValidate.js">
    </script>
</body>
</html>