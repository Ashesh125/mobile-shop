<?php
    include "configuration.php";
   
    if($_GET){
        $id = $_GET['cat_id'];
        $sql = "DELETE FROM tbl_catagories WHERE cat_id = $id";
        
        if(mysqli_query($conn, $sql)){
            header('Location:http://localhost/mobile%20shop/backend/addAdminInfo.php');
            // exit();
        }else{
            echo "One or more products are associated with this catagory!\nPlease delete those products before deleting the catagory!
                <a href='http://localhost/mobile%20shop/backend/addAdminInfo.php'>Go back</a>";
            
        }
    }
    mysqli_close($conn);
?>