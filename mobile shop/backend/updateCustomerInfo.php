<?php
    include "configuration.php";

    if($_POST){
        $id = $_POST['id'];
        $originalPswd = $_POST['originalPswd'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

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
        
        $sql = "UPDATE tbl_customers set c_name = '$full_name', c_password = '$encryptedpswd', c_email = '$email', c_phone = '$phone' where c_id = '$id'";
    
        if(mysqli_query($conn,$sql)){
            echo "ok";
            // include 'file:///E:/projects/mobile_shop/index.html';
            header('Location: http://localhost/mobile%20shop/backend/fetchCustomerInfo.php');
        }else{
            // echo $id;
            // echo "not ok";
            // echo $sql;
            header('Location: http://localhost/mobile%20shop/backend/fetchCustomerInfo.php');
            echo "<script>
                alert('Something Went Wrong');
            </script>";
        }
    }
?>
