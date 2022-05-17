<?php
    session_start();
    $name = " Welcome";
    
    if(isset($_SESSION['user'])){  
        //$test = $_SESSION['user'];
        $name = $name." ".$_SESSION['user'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
        <link rel="stylesheet" href="http://localhost/mobile%20shop/css/style.css" />
    </head>
    <body class="home">
    <div class="w-100 info-section">
        <section class="container d-flex py-1" style="justify-content: space-between;">
            <span><i class="far fa-clock pr-2"></i>8:00am-6:00pm</span>
            <span><i class="fas fa-user-circle"></i><?=$name?></span>
        </section>
    </div>
    <nav class="navbar navbar-expand-lg justify-content-sm-start py-0">
        <div class="container">

            <a class="navbar-brand mt-0" href="index.php">
                <img src="image/logo.svg" height="41px">
            </a>

            <button id="ChangeToggle" class="navbar-toggler" type="button">
				<span class="line"></span> 
				<span class="line"></span> 
				<span class="line" style="margin-bottom: 0;"></span>
			</button>

            <div class="collapse navbar-collapse p-lg-0 mt-lg-0 d-flex flex-column flex-lg-row justify-content-lg-end mobileMenu" id="navbarSupportedContent">

                <ul class="navbar-nav align-self-stretch">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://localhost/mobile%20shop/index.php">
                            <span class="fa-icon"><i class="fas fa-home"></i></span> Home
                        </a>
                    </li>
                    <li class="dropdown nav-item">
						<a class="dropdown-toggle nav-link" type="button" id="dropdownMenuProduct" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="fa-icon"><i class="fas fa-user"></i></span>
						     Product
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuProduct">
                            <a class="dropdown-item" href="service.php?cat_id=1">
								Laptops
							</a>
						  	<a class="dropdown-item" href="service.php?cat_id=2">
								Mobiles
							</a>
                            <a class="dropdown-item" href="service.php?cat_id=8">
								Laptop Acessories
							</a>
						  	<a class="dropdown-item" href="service.php?cat_id=5">
								Mobile Acessories
							</a>
                            <a class="dropdown-item" href="service.php?cat_id=9">
								Miscellaneous
							</a>
						</div>
					</li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="http://localhost/mobile%20shop/index.php#service">
                            <span class="fa-icon"><i class="fas fa-cogs"></i></span> Service
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/mobile%20shop/about.php">
                            <span class="fa-icon"><i class="fas fa-user"></i></span> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/mobile%20shop/contact.php">
                            <span class="fa-icon"><i class="fas fa-mobile-alt"></i></span> Contact
                        </a>
                    </li>
                    <?php if(isset($_SESSION['user'])){?>
                        <li class="nav-item">
                        <a class="nav-link" href="http://localhost/mobile%20shop/cart.php">
                            <span class="fa-icon"><i class="fas fa-shopping-cart"></i></span>
                        </a>
                    </li>            
                    
                    <?php } ?>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fa-icon"><i class="fas fa-user"></i></span> Account
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" id="dropdown-login" href="login.php">Login</a>
                            <a class="dropdown-item" id="dropdown-logout" href="http://localhost/mobile%20shop/backend/logout.php" style="display: none;">Logout</a>
                            <a class="dropdown-item" id="dropdown-register" href="register.php">Register</a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    
     <!-- jQuery library -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libss/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    </body>
</html>