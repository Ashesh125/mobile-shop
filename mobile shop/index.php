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

    <!-- home section -->
    <section class="container" id="home">
        <div class="row" style="min-height:85vh;">
            <div class="col-12 col-lg-6 center-content">
                <div class="mt-4 mt-lg-0">
                    <h1 class="title heading">Quill <span class="focus-title">Mobile Shop</span> & <span class="focus-title">Repairing Center</span>
                    </h1>
                    <div class="d-lg-none mt-3 image-div">
                        <img src="image/devices1.png" class="image img-fluid">
                    </div>
                    <p class="pt-3 description">
                        We will provide you good quality of Mobile accessories and Repairing sevices of Mobile and Laptop at minimun prices under same roof. Photocopy and Money Transfer are also available.
                    </p>
                    <div class="row text-center">
                        <div class="col-6 col-md-3 mt-1">
                            <i class="fas fa-tools service-icon"></i>
                            <small class="d-block">Repairing sevices</small>
                        </div>
                        <div class="col-6 col-md-3 mt-1">
                            <i class="fas fa-briefcase service-icon"></i>
                            <small class="d-block">Mobile & Laptop accessories</small>
                        </div>
                        <div class="col-6 col-md-3 mt-1">
                            <i class="fas fa-print service-icon"></i>
                            <small class="d-block">Photocopy</small>
                        </div>
                        <div class="col-6 col-md-3 mt-1">
                            <i class="fas fa-wallet service-icon"></i>
                            <small class="d-block">Money Transfer</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 center-content display-none">
                <div class="mx-auto">
                    <img src="image/devices1.png" width="450px">
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="container text-center" id="service" style="min-height:85vh;">
        <h2 class="heading mb-0" style="font-size: 40px;">SERVICES</h2>
        <div class="row">
			<div class="col-12 col-md-4 col-lg-3 mt-4">
				<div class="card">
					<a href="service.php?cat_id=1">
						<img class="card-img-top" src="image/laptop.jfif" alt="parts">
						<div class="card-body">
							<h5 class="card-text">Laptops</h5>
						</div>
					</a>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-3 mt-4">
				<div class="card">
					<a href="service.php?cat_id=2">
						<img class="card-img-top" src="image/mobile.jfif" alt="mobile accessories">
						<div class="card-body">
							<h5 class="card-text">Mobiles</h5>
						</div>
					</a>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-3 mt-4">
				<div class="card">
					<a href="service.php?cat_id=5">
						<img class="card-img-top" src="image/mobile_parts.png" alt="software">
						<div class="card-body">
							<h5 class="card-text">Mobile Accessories</h5>
						</div>
					</a>
				</div>
			</div>

			<div class="col-12 col-md-4 col-lg-3 mt-4">
				<div class="card">
					<a href="service.php?cat_id=8">
						<img class="card-img-top" src="image/laptop_parts.png" alt="hardware">
						<div class="card-body">
							<h5 class="card-text">Laptop Accessories</h5>
						</div>
					</a>
				</div>
			</div>
            <div class="col-12 col-md-4 col-lg-3 mt-4">
				<div class="card">
					<a href="service.php?cat_id=9">
						<img class="card-img-top" src="image/miscellaneous.jfif" alt="hardware">
						<div class="card-body">
							<h5 class="card-text">Miscellaneous</h5>
						</div>
					</a>
				</div>
			</div>
            <div class="col-12 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    <img class="card-img-top" src="image/hardware.png" alt="hardware">
                    <div class="card-body">
                        <h5 class="card-text">Hardware fixes</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    <img class="card-img-top" src="image/software_fixes.png" alt="hardware">
                    <div class="card-body">
                        <h5 class="card-text">Software fixes</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
<?php
    include 'index_body/footer.php';
?>