<?php
    include "configuration.php";

    if($_POST){
        $id = $_POST['admin_id'];
        $originalPswd = $_POST['admin_pswd'];
        $name = $_POST['admin_name'];
        $password = $_POST['admin_pswd'];

        $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = "a44afb0b6808d662";

        //echo $originalPswd . $password;

        if($originalPswd === $password){
            $encryptedpswd = $originalPswd;
        }else{
            $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
        }
        
        $sql = "UPDATE tbl_admin set admin_name = '$name', admin_pswd = '$encryptedpswd' where admin_id = '$id'";
    
        if(mysqli_query($conn,$sql)){
            echo "ok";
            // include 'file:///E:/projects/mobile_shop/index.html';
            header('Location: http://localhost/mobile%20shop/backend/addAdminInfo.php');
        }else{
            // echo $id;
            // echo "not ok";
            // echo $sql;
            echo "<script>
                alert('Something Went Wrong');
                </script>";
            header('Location: http://localhost/mobile%20shop/backend/addAdminInfo.php');
            
        }
    }
?>
