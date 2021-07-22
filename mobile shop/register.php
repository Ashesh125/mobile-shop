<?php 
    include 'index_body/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>mobile shop</title>
    <link rel="shortcut icon" href="image/favicon.ico" type="image/png" />
</head>

<body>
    <div class="overlay"></div>
    <section class="container login" style="min-height: 80vh;">
        <div class="row" style="min-height: 80vh; align-items: center; justify-content: center;">
            <div class="col-12 col-md-6 mt-3 m-md-0 order-1 order-md-0">
                <img src="image/login.jpeg" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 mt-2 m-md-0 order-0 order-md-1">
                <h1 class="heading position-relative pb-2">REGISTER</h1>
                <form name="form-register" class="pt-3" method="POST" action="http://localhost/mobile%20shop/backend/insertCustomerInfo.php">
                    <div class=" form-group ">
                        <label for="exampleInputName ">Name</label>
                        <input type="text " class="form-control " id="exampleInputName" placeholder="Enter name " name="full_name">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputEmail1 ">Email address</label>
                        <input type="email" class="form-control " id="exampleInputEmail1 " name="email" aria-describedby="emailHelp" placeholder="Enter email ">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPhone ">Phone Number</label>
                        <input type="text " class="form-control " id="exampleInputPhone " name="phone" placeholder="Enter Mobile Number ">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword1 ">Password</label>
                        <input type="password " class="form-control " id="exampleInputPassword1 " name="password" placeholder="Password ">
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputPassword2 ">Confirm Password</label>
                        <input type="password " class="form-control " id="exampleInputPassword2" name="cpassword" placeholder="Confirm Password ">
                    </div>
                    <button type="submit " class="btn btn-primary" id="submit" onclick="return validateRegister();">Submit</button>
                </form>
            </div>
        </div>
    </section>

   
</body>
<script>
function validateRegister() {
    let name = document.forms['form-register']['full_name'].value;
    let email = document.forms['form-register']['email'].value;
    let pswd = document.forms['form-register']['password'].value;
    let cpswd = document.forms['form-register']['cpassword'].value;
    let phone = document.forms['form-register']['phone'].value;
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
    }else if(pswd !== cpswd){
        alert('Password and Confirm password do not match!');
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
</html>
<?php
    include 'index_body/footer.php';
?>