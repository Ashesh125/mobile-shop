<?php
    session_start();
    include "configuration.php";
    // echo "Asd";
    
    $_SESSION['errorNotFound'] = false;   
    $_SESSION['errorInvalidEmail'] = false;
    $_SESSION['errorIncorrectPassword'] = false;

    if ($_POST) {
        //bring data to server
        $name = $_POST['email'];
        $password = $_POST['password'];

        $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = "a44afb0b6808d662";

        $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
        
        if (filter_var($name, FILTER_VALIDATE_EMAIL)){
          $sql = "SELECT * from tbl_customers WHERE c_email = '$name'";
          $result = mysqli_query($conn, $sql); 
          
          if($result == true){
            
            
            $row = mysqli_fetch_assoc($result);
            
            $user = Array(
              'id' => $row['c_id'],
              "email" => $row['c_email'],
              "password" => $row['c_password']
            );
            if($user['email'] == $name ){

              if($user['password'] == $encryptedpswd){
                 
                $_SESSION["user"] = $row['c_name'];
                $_SESSION["userId"] = $row['c_id'];

                header('Location:http://localhost/mobile%20shop/index.php');
              }else{
                $_SESSION["errorIncorrectPassword"] = true;
                header('Location:http://localhost/mobile%20shop/login.php');        
              }
            }else{
              $_SESSION['errorNotFound'] = true;
              header('Location:http://localhost/mobile%20shop/login.php');
                 
            }
          }else{
            $_SESSION['errorNotFound'] = true;
            header('Location:http://localhost/mobile%20shop/login.php');
            
          }
        } else{

          //fetch data from database
          $sql = "SELECT * FROM tbl_admin WHERE admin_name = '$name' and admin_password = '$encryptedpswd'";    
          $result = mysqli_query($conn, $sql);
              //echo $sql;
              
              $row = mysqli_fetch_assoc($result);

              // if($row = 0){
              //   echo "<script>
              //     return alert('Cannot Find Account');
              //   </script>";
              //   header('Location:http://localhost/mobile%20shop/login.php');
              // }

              $admin = Array(
                  "name" => $row['admin_name'],
                  "password" => $row['admin_password']
              );
              if($admin['name'] == $name && $admin['password'] == $encryptedpswd){
               
                $_SESSION["admin"] = $name;
                
                header('Location:http://localhost/mobile%20shop/backend/dashboardMain.php');
                
              }else{
                //     echo "<script>alert($admins[$i][1]);</script>";
                // echo $sql;
                // print_r($admin);
                $_SESSION['errorInvalidEmail'] = true;
                header('Location:http://localhost/mobile%20shop/login.php');
                
                 } 
            
            }
       
        
        
    mysqli_close($conn);
    }
?>