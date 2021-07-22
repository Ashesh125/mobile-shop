<?php
    include "dashboard.php";
    include "configuration.php";
    include 'fetchCatagories(C).php';

    if($_POST){
         
        $admin_name = $_POST['admin_name'];
        $pswd = $_POST['admin_pswd'];
        $cpswd = $_POST['confirm_pswd'];
        
            $ciphering = "AES-128-CTR"; 
            $iv_length = openssl_cipher_iv_length($ciphering); 
            $options = 0; 
            $encryption_iv = '1234567891011121';
            $encryption_key = "a44afb0b6808d662";

            $encryptedpswd = openssl_encrypt($pswd, $ciphering, $encryption_key, $options, $encryption_iv);
    
            $sql = "INSERT INTO tbl_admin (admin_name, admin_password) values ('$admin_name','$encryptedpswd')";
            
            if(mysqli_query($conn,$sql)){
                echo "<script>
                   alert('New Admin Created');
                </script>";
            }else{
                echo "<script>
                   alert('ERROR !!!');
                </script>";                
               header('Location:http://localhost/mobile%20shop/backend/addAdminInfo.php');
            }
        

        }
    

    $sql2 = "SELECT * FROM tbl_admin";    
    $result = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result) > 0) {
        if (mysqli_num_rows($result) == 1) {
                $show = "no";
            }else{
                $show="yes";
            }
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
        
          $admins[$i] = Array(
              $row['admin_id'],
              $row['admin_name'],
              $row['admin_password']
          );
          $i++;
        }
      } 
  
  mysqli_close($conn);
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/validateAdmin.js"></script>

</head>

<body>
    <div id="main_content">
            <div class="flex-row">
                <div class="catagory-form"> 
                    <form name="form-3" id="form-3" method="POST" action="http://localhost/mobile%20shop/backend/catagory.php">
                        <label for="cat_name">Catagory Name</label>
                        <input type="text" name="cat_name" />
                        <input type="submit" value="Submit" onclick="return validateCatagory();" id="submit"/>
                    </form>
                </div>
                <div id="admin-form">
                    
                    <form name="form-2" id="form-2" method="POST">
                        <label for="admin_name">Admin Name</label>
                        <input type="text" name="admin_name" />
                        <label for="admin_pswd">Password</label>
                        <input type="password" name="admin_pswd" />
                        <label for="confirm_pswd">Confirm Password</label>
                        <input type="password" name="confirm_pswd" />
                        <input type="submit" value="Submit" onclick="return validateAdminInfo();" id="submit"/>
                    </form>

                </div>
            </div>
            <div class="flex-inside">
            <div id="admin-table">
                <table>
                    <caption>Admins</caption>
                    <tr>
                        <th class="smol">S.N.</th>
                        <th>Admin Name</th>
                        <th>Password</th>
                        <th class="smol">Delete</th>
                    </tr>
                    <?php foreach($admins as $index => $admin){ ?>
                    <tr>
                        <td><?=$index + 1?></td>
                        <td><?=$admin[1]?></td>
                        <td><?=$admin[2]?></td>
                        
                        <td>
                            <a class="ud" id="<?php echo $show?>" id="delete" href="http://localhost/mobile%20shop/backend/deleteAdmin.php?admin_id=<?=$admin[0]?>" onclick="return confirm('Confirm Deletion ???');"><i class="fas fa-trash-alt"></i></a>
                        </td>  
                    </tr>
                    <?php } ?>
                </table>
            </div>
          
            
        </div>
        <div class="flex-inside">
        <div id="cat-table">
                <table>
                    <caption>Catagories</caption>
                    <tr>
                        <th class="smol">S.N.</th>
                        <th>Catagory Name</th>
                        <th class="smol">Delete</th>
                    </tr>
                    <?php foreach($catagories as $index => $catagory){ ?>
                    <tr>
                        <td><?=$catagory['id']?></td>
                        <td><?=$catagory['name']?></td>
                        <td>   
                            <a class="ud" id="delete" href="http://localhost/mobile%20shop/backend/deleteCatagory.php?cat_id=<?=$catagory['id']?>" onclick="return confirm('Confirm Deletion ???');"><i class="fas fa-trash-alt"></i></a>
                        </td>  
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        
    </div>
</body>
<script src="../js/productValidate.js">
        
    </script>
<style>

#cat-table{
    width: 50%;
    margin-left: 12%;
    margin-right: 40%;
    margin-top: auto;
}

#main_content{
    margin-left: 13%;
    height: auto;
}
input{
    width: 210px;
    height: 22px;
    margin-left: 40px;
}
div{
    margin: 10px;
}
label{
    font-size: 20px;
    font-weight: bold;
    margin-top: 8px;
}
input[type = 'submit']{
    width: 70px;
    height: 30px;
    margin-left: 110px;
    margin-top: 8px;
}


#admin{
  
    background-color: lavender; 
}
#UformTitle{
    font-size: 20px;
}
table{
    width:50%;
    margin-right: 20%;
    
    position: relative;
}

#no{
    display: none;
}
</style>
</html>