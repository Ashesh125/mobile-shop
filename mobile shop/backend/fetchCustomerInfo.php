<?php
    include "dashboard.php";
    include "configuration.php";

    $sql = "SELECT * FROM tbl_customers";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        while($row = mysqli_fetch_assoc($result)) {
        
          $customers[$i] = Array(
              "id" => $row['c_id'],
              "full_name" => $row['c_name'],
              "password" => $row['c_password'],
              "email" => $row['c_email'],
              "phone" => $row['c_phone']
          );
          if($i == 0){
            $initial = $customers[0]['id'];
          }
        // $ciphering = "AES-128-CTR"; 
        // $iv_length = openssl_cipher_iv_length($ciphering); 
        // $options = 0; 
        // $decryption_iv = '1234567891011121';
        // $decryption_key = "a44afb0b6808d662";
        
        // $decryptedpswd = openssl_decrypt ($customers[$i][3], $ciphering, $decryption_key, $options, $decryption_iv); 
        // $customers[$i][3] = $decryptedpswd;
        
          $i++;
        }
      } 
      
  mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
    </title>
    <script src="https://kit.fontawesome.com/552433a799.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dashboard.css" />
  </head>
  <body>

    <div id="main_content">
    <table id="customersTable">
        <tr>
            <th class="smol">S.N.</th>
            <th>Full Name</th>
            <th>Password</th>
            <th>E-mail</th>
            <th>Mobile Number</th>
            <th class="smol">Update</th>
            <th class="smol">Delete</th>
        </tr>
        <?php foreach($customers as $index => $customer){ ?>
        <tr>
            <td><?=$customer['id']?></td>
            <td><?=$customer["full_name"]?></td>
            <td><?=$customer["password"]?></td>
            <td><?=$customer["email"]?></td>
            <td><?=$customer["phone"]?></td>
            <td>
              <a class="ud" id="update" onclick="return validate(<?=$customer['id']?>);"><i class="fas fa-cloud-upload-alt" id="updateBtn"></i></a>
            </td>
            <td>   
              <a class="ud" id="delete" href="http://localhost/mobile%20shop/backend/deleteCustomerInfo.php?c_id=<?=$customer['id']?>" onclick="return confirm('Confirm Deletion ???');"><i class="fas fa-trash-alt"></i></a>
            </td>  
        </tr>
        <?php } ?>
    </table>
    </div>
    <div id="Uform">
      <div id="UformTitle">
          <span style="text-decoration: underline;">Update Form</span>
          <i id="close" class="fa fa-window-close-o" onclick="document.getElementById('Uform').style.display = 'none'"></i>
      </div>
      <form name="form-3" id="form-3" method="POST" action="http://localhost/mobile%20shop/backend/updateCustomerInfo.php">

        <input 
          type="hidden" 
          name="id" 
          id= 'id'
        />

        <input
          type="hidden"
          name="originalPswd"
          id="originalPswd"
        />

        <label for="full_name">Name</label>
        <input 
          type="text" 
          placeholder="Name" 
          name="name" 
          id="full_name" 
          required  
        />


        <label for="phone">Phone </label>
        <input 
          type="text" 
          placeholder="Phone" 
          name="phone"
          id="phone"
          required
        />
        <label for="email">E-mail</label>
        <input 
          type="text" 
          placeholder="E-mail" 
          name="email"
          id="email" 
          required  
        />

        <label for="password">Password</label>
        <input 
          type="password" 
          placeholder="Password" 
          name="password" 
          id="password"
          required 
        />

        <input type="submit" value="Submit" id="submit" onclick="return validateRegister()"/>
      </form>
    </div>  
  </body>
  <script src="../js/script.js"></script>
  <script>

    function validate(id){
     // alert(id);
      id = id + "";
      let oTable = document.getElementById('customersTable');
      let rowLength = oTable.rows.length;

      let count = 1;
      for (i = <?=$initial?>; i <= id; i++){
        //alert("row"+i); 

       let oCells = oTable.rows.item(count++).cells;
      //   alert(oCells.item(0).innerHTML)
      //  alert("cell"+i+ "   "+oCells.item(0).innerHTML+" "+oCells.item(4).innerHTML.value+" "+oCells.item(2).innerHTML+ " "+oCells.item(3).innerHTML);
        if (oCells.item(0).innerHTML === id){
          document.getElementById('id').value = id;
          document.getElementById('originalPswd').value = oCells.item(2).innerHTML;
          document.getElementById('password').value = oCells.item(2).innerHTML;
          //alert(oCells.item(2).innerHTML);
          document.getElementById('phone').value = oCells.item(4).innerHTML;
          document.getElementById('full_name').setAttribute('value',oCells.item(1).innerHTML);  
          document.getElementById('email').value = oCells.item(3).innerHTML;
        } 
        document.getElementById('Uform').style.display = 'block';
      
}
    }

function validateRegister() {
    let name = document.forms['form-3']['name'].value;
    let email = document.forms['form-3']['email'].value;
    let pswd = document.forms['form-3']['password'].value;
    let phone = document.forms['form-3']['phone'].value;
    // alert(name);

    if(name == ""){
        alert('Name cannot be empty');
        return false;
    }else if(email == ""){
        alert('Email cannot be empty');
        return false;
    }else if(pswd == ""){
        alert('Password cannot be empty');
        return false;
    }else if(phone == ""){
        alert('Phone number cannot be empty');
        return false;
    }

    if(pswd.length< 8){
        alert('Please enter a longer password');
        return false;
    }

    if(phone.length != 10){
        alert('Invalid Phone no!');
        return false;    
    }
    if(!validateEmail(email)){
        alert("Email is invalid!");
        return false;
    }
    return true;
}
function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

  </script>
  <style>
    #UformTitle {
    font-size: 30px;
    margin: 8px;
    font-weight: bold;
    }



    .fa{
      float: right;
    }

    .fa:hover{
      color: red;
    }

    #Uform{
      border-radius: 20px;
      width: 400px;
      height: 425px;
      background-color: #a29bfe;
      position: fixed;
      left: 40%;
      top: 90px;
      display: none;
      box-shadow: 10px 10px 11px 0px #000000;
    }

  
    #customerInfo{
      background-color: lavender;
      border-radius: 0px;
      border-top-left-radius: 30px;
      border-bottom-left-radius: 30px;
      
    }

    input{
      width: 62%;
      height: 30px;
      margin-left: auto;
      margin-right: auto;
      outline: none;
      border: 4px solid #a29bfe;
    }
	input[type="submit"]{
		margin:auto;
	}

    label{
      font-size: 22px;
      font-weight: bold;
      text-decoration: underline;
      margin-left: 20px;
      margin-top: 30px;
    }

    input:focus{
      border: 4px solid green;
    }

</style>
</html>
