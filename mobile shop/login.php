<?php 
    include 'index_body/header.php';
    
    if(isset($_SESSION['errorNotFound'])){
        if($_SESSION['errorNotFound'] == true){
            echo "
              <script>alert('Account Does not Exist! Please Register to Create An Account!');</script>
            ";
            $_SESSION['errorNotFound'] = false;
        }    
    }
    if(isset($_SESSION['errorIncorrectPassword'])){
        if($_SESSION['errorIncorrectPassword'] == true){
            echo "
              <script>alert('Password is Incorrect! ');</script>
            ";
        }
        $_SESSION['errorIncorrectPassword'] = false;
    } 
    if(isset($_SESSION['errorInvalidEmail'])){
        if($_SESSION['errorInvalidEmail'] == true){
            echo "
              <script>alert('Invalid Email!')</script>
            ";
            $_SESSION['errorInvalidEmail'] = false;
        }
    } 
    if(isset($_SESSION['errorEmailExists'])){   
        if($_SESSION['errorEmailExists'] == true){
            echo "
              <script>alert('You Already Have an Account with this Email! Please Log in!');</script>
            ";
            $_SESSION['errorEmailExists'] = false;
        }
    }
    $email = "";
    if($_GET){
        $email = $_GET['email'];
    }
    
    
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

<body onload="choice()">
  
    <div class="overlay"></div>

    <section class="container login" style="min-height: 80vh;">
        <div class="row" style="min-height: 80vh; align-items: center; justify-content: center;">
            <div class="col-12 col-md-6 mt-3 m-md-0 order-1 order-md-0">
                <img src="image/login.jpeg" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 mt-2 m-md-0 order-0 order-md-1">
                <h1 class="heading position-relative pb-2">LOGIN</h1>
                <form class="pt-3" method="POST" action="http://localhost/mobile%20shop/backend/login.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="<?=$email?>" aria-describedby="emailHelp" placeholder="Enter email" required />
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input id="password" type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required />
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary" id="btnLogin">Submit</button>
                </form>
            </div>
        </div>
    </section>

</body>

</html>
<?php
    include 'index_body/footer.php';
?>