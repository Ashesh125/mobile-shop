<?php
    include 'index_body/header.php';
    if(!isset($_SESSION['user'])){
        header('Location:http://localhost/mobile%20shop/backend/logout.php');
    }
    

    if($_GET){
        $bill_no = $_GET['bill'];
        $location = $_GET['location'];
        $gTotal = $_GET['price'];
        $p_id = $_GET['p_id'];
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

<body>
    
    <div class="overlay"></div>

    <section class="container pt-5" style="min-height: 80vh;">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment" id="cash" checked>
            <label class="form-check-label" for="cash">
              Cash on delivery
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment" id="ebanking">
            <label class="form-check-label" for="ebanking">
              Ebanking
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment" id="esewa">
            <label class="form-check-label" for="esewa">
              Esewa
            </label>
        </div>
        <p class="mt-3">
            <span class="text-danger">Note: </span>By clicking submit button your order is final. If you want to cancel it then <a href="http://localhost/mobile%20shop/contact.php">contact </a>us
        </p>
        <button class="btn btn-primary mt-1" id="order">Submit</button>


        <div id="alert2">
        Your Order Has Been Set.<br />
        One of our Administrators will contact You Shortly.<br />
        Your Bill No is <span id="billno" style="color: cyan;"><h3><?=$bill_no?></h3></span>.
        Please take a screenshot or note down the Bill Number<br />
        Thank You for Ordering From Quill Mobile Shop and Repairing Center.<br>
        Click here to send your Order.
        </div>
    </section>


   
</body>
 <script> 
        
        document.getElementById("order").onclick = function(){  
            document.getElementById('alert2').style.display = "block";
            
		document.querySelector('#alert2').onclick = function(){
                let today = new Date();
                let datee = today.getFullYear()+'/'+(today.getMonth()+1)+'/'+today.getDate();
                let url = "http://localhost/mobile%20shop/backend/setOrder.php?bill=<?=$bill_no?>&location=<?=$location?>&date="+datee+"&price=<?=$gTotal?>&p_id=<?=$p_id?>&c_id=<?=$_SESSION["userId"]?>";
                
		window.location.href = url;
            };  
        };

      
  </script>
<style>
	#alert2{
		position:absolute;
		top:30%;
		left: 30%;
		border-radius:10px;
		border:2px solid blue;
		background-color : black;
		color: white;
		text-align:center;
	}
</style>
</html>
<?php
    include 'index_body/footer.php';
?>

