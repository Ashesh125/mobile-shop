<?php
    include "configuration.php";
   
    if($_GET){
        $id = $_GET['admin_id'];
        $sql = "DELETE FROM tbl_admin WHERE admin_id = $id";
        
        if(mysqli_query($conn, $sql)){
            header('Location:http://localhost/mobile%20shop/backend/addAdminInfo.php');
            // exit();
        }
    }
    mysqli_close($conn);
?>