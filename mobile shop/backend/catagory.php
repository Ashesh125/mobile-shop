<?php
    include "configuration.php";
    
    if($_POST){
        $catName = $_POST['cat_name'];
        // if($catName == ""){
        //     echo "<script>
        //         alert('Password and Confirm Password Do Not Match!');
        //         </script>
        //     ";
        // }else{
            
            $sql = "Insert into tbl_catagories (cat_name) values ('$catName')";
            if(mysqli_query($conn,$sql)){
                // include 'file:///E:/projects/mobile_shop/index.html';
                header("Location:http://localhost/mobile%20shop/backend/addAdminInfo.php");
            }else{
                header('Location:http://localhost/mobile%20shop/backend/addAdminInfo.php');
            }
     //   }
    }
?>