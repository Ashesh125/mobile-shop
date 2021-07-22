<?php
    session_start();

    if(!isset($_SESSION["admin"])){
        header('Location:http://localhost/mobile%20shop/backend/logout.php');
    }
        // echo $_SESSION['admin'];
        // 2 hours in seconds
    $inactive = 7200;

    $_SESSION['expire'] = time() + $inactive; // static expire


    if(time() > $_SESSION['expire'])
    {  
        header('Location:http://localhost/mobile%20shop/backend/logout.php');
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><link rel="stylesheet" href="../css/product-form.css">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://kit.fontawesome.com/552433a799.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="navigation">
        <li id="logo">
            <a href="http://localhost/mobile%20shop/index.php" style="border: none;"><img src="logo.svg" height="60px" width="90px" /></a>
        </li>
        <li class="links" id="dashboardMain">
            <a href="http://localhost/mobile%20shop/backend/dashboardMain.php">Home</a>
        </li>
        <li class="links" id="customerInfo">
            <a href="http://localhost/mobile%20shop/backend/fetchCustomerInfo.php">Customers Info</a>
        </li>
        <li class="links" id="products">
            <a href="http://localhost/mobile%20shop/backend/fetchProductInfo.php">Products </a>
        </li>
        <li class="links" id="addProduct">
            <a href="http://localhost/mobile%20shop/backend/productForm.php">Add Product</a>
        </li>
        <li class="links" id="ordersP">
            <a href="http://localhost/mobile%20shop/backend/fetchOrders.php">Orders (P)</a>
        </li>
        <li class="links" id="ordersC">
            <a href="http://localhost/mobile%20shop/backend/fetchCompletedOrders.php">Orders (C)</a>
        </li>
        <li class="links" id="admin">
            <a href="http://localhost/mobile%20shop/backend/addAdminInfo.php">Add/Modify User</a>
        </li>
        <li class="links" id="logout">
            <a href="http://localhost/mobile%20shop/backend/logout.php">Logout</a>
        </li>
        
    </div>
</body>
<style>
    
</style>

</html>