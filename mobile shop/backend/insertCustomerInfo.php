<?php
    session_start();
    include "configuration.php";

    $_SESSION['errorEmailExists'] = false;
    if($_POST){
        
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $check = "SELECT * FROM tbl_customers WHERE c_email='$email'";
        $result = mysqli_query($conn, $check);
        if($result == true){
             
            $row = mysqli_fetch_assoc($result);
            
            if($row['c_email'] == $email ){
                $_SESSION['errorEmailExists'] = true;
                
                header('Location:http://localhost/mobile%20shop/login.php');
              }


        }
        $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = "a44afb0b6808d662";

        $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
        
        $sql = "Insert into tbl_customers (c_name, c_password, c_email, c_phone) values ('$full_name','$encryptedpswd','$email','$phone')";
    
        if(mysqli_query($conn,$sql)){
            // include 'file:///E:/projects/mobile_shop/index.html';
            $sql_update = "UPDATE tbl_count set count_no = count_no + 1 where count_type = 'Logged In Users'";
            mysqli_query($conn,$sql_update);
            header("Location:http://localhost/mobile%20shop/login.php?email=$email");
        }else{
            header('Location:http://localhost/mobile%20shop/index.php');
        }
    }
?>