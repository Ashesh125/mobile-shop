<?php
    include 'dashboard.php';
    include 'fetchCatagories(C).php';
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
        <form id="product-form" name="product-form" method="POST" action="http://localhost/mobile%20shop/backend/insertProductInfo.php?mode=0">
            <div id="left">
            <fieldset>
                <legend>Primary Info</legend>
            <label for="pname">Product Name</label>
            <input type="text" placeholder="Name" name="pname" required>
            <label for="price">Price</label>
            <input type="number" placeholder="Price (Rs)" name="price" required>
            <label for="discount">Discount</label>
            <input type="number" placeholder="Discount (%)" name="discount" value=0>
            <label for="qty">Quantity</label>
            <input type="number" placeholder="qty" name="qty" required>
            <label for="catagories">Catagory</label>
            <select name="cat_id" id="catagories">
                <?php foreach($catagories as $index => $catagory) {?>
                    <option value="<?=$catagory['id']?>"><?=$catagory['name']?></option>
                <?php }?>
            </select>
            <label for="img_name">Image name</label>
            <input type="text" placeholder="Image name with extension" name="img_name" value="devices.svg" required>
            </fieldset>    
            
            </div>
            
            
            <div id="right">
                <fieldset>
            <legend>Additional Info </legend>
            <label for="processor">Processor</label>
            <input type="text" placeholder="Processor" name="processor">
            <label for="graphics">Graphics/Camera</label>
            <input type="text" placeholder="Graphics/Camera" name="graphics">
            <label for="ram">RAM</label>
            <input type="text" placeholder="Ram" name="ram">
            <label for="storage">Storage</label>
            <input type="text" placeholder="Storage" name="storage">
            <label for="display">Display</label>
            <input type="text" placeholder="Display" name="display">
            <label for="color">Colors</label>
            <input type="text" placeholder="red,green" name="color">
            <label for="battery">Battery (mAh)</label>
            <input type="number" placeholder="Battery" name="battery">
            
            </fieldset>  
            <input type="submit" onclick="return validateProductInfo();" value="Submit">  
            </form>
        </div>

        </div>
    
    </div>
    
</body>
    
    <script src="../js/productValidate.js">
         
    </script>
    <style>
        #addProduct {
            background-color: lavender;
        }
    </style>
</html>