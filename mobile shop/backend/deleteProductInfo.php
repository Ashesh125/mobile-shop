<?php
    include "configuration.php";
    session_start();

    $_SESSION['errorCannotDelete'] = false;
    if($_GET){
        $id = $_GET['p_id'];
        $sql = "DELETE tbl_products,tbl_descriptions FROM tbl_products inner join tbl_descriptions WHERE tbl_products.p_id=tbl_descriptions.p_id and tbl_products.p_id = $id";
        // echo $sql;
        if(mysqli_query($conn, $sql)){
            header('Location:http://localhost/mobile%20shop/backend/fetchProductInfo.php');
            // exit();
        }else{
            $_SESSION['errorCannotDelete'] = true;
            echo $_SESSION['errorCannotDelete'];
            header('Location:http://localhost/mobile%20shop/backend/fetchProductInfo.php');
        }
    }
    mysqli_close($conn);
?>