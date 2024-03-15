	<!-- header Start -->
	
	<?php 
		require_once('include/db_file/config.php');
		require_once('include/db_file/connection_file.php');
		include('include/main_file/topbar.php');
		include('include/main_file/header.php');
		
		
		
	?>
	
	<!-- header End -->
	
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?php echo DTS_WS_SITE_IMG ?>carousel-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?php echo DTS_WS_SITE_IMG ?>carousel-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="<?php echo DTS_WS_SITE_IMG ?>carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Kids Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?php echo DTS_WS_SITE_IMG ?>offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="<?php echo DTS_WS_SITE_IMG ?>offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
			<?php 
				// Select Category 
				
				$sql1 = "SELECT * FROM category WHERE status = '1' LIMIT 12";
				
				$result_category = $conn->query($sql1);
				
				if ($result_category->num_rows > 0) {
					while ($row1 = $result_category->fetch_assoc()) 
					{
					   
			?>
						<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
							<a class="text-decoration-none" href="">
								<div class="cat-item d-flex align-items-center mb-4">
									<div class="overflow-hidden" style="width: 100px; height: 100px;">
									   <img class="img-fluid" src="<?php echo DTS_WS_SITE_ADMIN_UPLOAD_IMG . $row1['cimg'] ?>" alt="">
									</div>
									<div class="flex-fill pl-3">
										<h6><?php echo $row1['cname']?></h6>
										<small class="text-body">100 product</small>
									</div>
								</div>
							</a>
						</div>
			<?php
					}
				}
			?>

        </div>
    </div>
    <!-- Categories End -->

    <!-- Products Start -->
		

		<div class="container-fluid pt-5 pb-3">
			<h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
			<div class="row px-xl-5">
				<?php 
					// Select Product 
					
					$sql2 = "SELECT * FROM product WHERE status = '1' LIMIT 12";
					
					$result_product = $conn->query($sql2);
					
					if ($result_product->num_rows > 0) {
						while ($row2 = $result_product->fetch_assoc()) 
						{
						   
				?>
				 <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
					<div class="product-item bg-light mb-4">
						<div class="product-img position-relative overflow-hidden">
						<?php 
							// Check if there are images for this product
							if (!empty($row2['product_img'])) {
								$images = explode(",", $row2['product_img']);
								foreach ($images as $key=>$image) {
									if($key == '0')
									{
							?>
								<img class="img-fluid w-100" src="<?php echo "online-shoping/".$image ?>" alt="">
							<?php
									}
									
								}
							}
						?>
							
							<div class="product-action">
								<a class="btn btn-outline-dark btn-square" href="cart.php"><i class="fa fa-shopping-cart"></i></a>
								<a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
								<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
								<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
							</div>
						</div>
						<div class="text-center py-4">
							<a class="h6 text-decoration-none text-truncate" href="detail.php?product_id=<?php echo $row2['product_id'] ?>"><?php echo $row2['product_name'] ?></a>
							<div class="d-flex align-items-center justify-content-center mt-2">
								<h5><?php echo $row2['price'] ?></h5><h6 class="text-muted ml-2"><del><i class="fa fa-inr" aria-hidden="true"></i>123.00</del></h6>
							</div>
							<div class="d-flex align-items-center justify-content-center mb-1">
								<small class="fa fa-star text-primary mr-1"></small>
								<small class="fa fa-star text-primary mr-1"></small>
								<small class="fa fa-star text-primary mr-1"></small>
								<small class="far fa-star text-primary mr-1"></small>
								<small class="far fa-star text-primary mr-1"></small>
								<small>(99)</small>
							</div>
						</div>
					</div>
				</div>
				<?php 
						}
					}
				?>
			</div>
		</div>
		<!-- Products End -->

	

    <!-- Offer Start -->
		
		<div class="container-fluid pt-5 pb-3">
			<div class="row px-xl-5">
				<div class="col-md-6">
					<div class="product-offer mb-30" style="height: 300px;">
						<img class="img-fluid" src="<?php echo DTS_WS_SITE_IMG ?>offer-1.jpg" alt="">
						<div class="offer-text">
							<h6 class="text-white text-uppercase">Save 20%</h6>
							<h3 class="text-white mb-3">Special Offer</h3>
							<a href="" class="btn btn-primary">Shop Now</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="product-offer mb-30" style="height: 300px;">
						<img class="img-fluid" src="<?php echo DTS_WS_SITE_IMG ?>offer-2.jpg" alt="">
						<div class="offer-text">
							<h6 class="text-white text-uppercase">Save 20%</h6>
							<h3 class="text-white mb-3">Special Offer</h3>
							<a href="" class="btn btn-primary">Shop Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
    <!-- Offer End -->
	

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo DTS_WS_SITE_IMG ?>product-8.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="cart.php"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="../front_page/cart.php">Product Name Goes Here</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$123.00</h5><h6 class="text-muted ml-2"><del><i class="fa fa-inr" aria-hidden="true"></i>123.00</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-1.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-2.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-4.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-6.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-7.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="<?php echo DTS_WS_SITE_IMG ?>vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


   <!-- Footer Start -->
	 
	<?php 
		include('include/main_file/footer.php');
	?>
	
	
</body>

</html>