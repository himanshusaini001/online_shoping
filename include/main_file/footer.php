  
  
  <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
		<?php
			$social_media_sql = "SELECT * FROM site_settings";
			$social_row = $conn->query($social_media_sql);
			if($social_row->num_rows > 0)
			{
				while($social_result = $social_row->fetch_assoc())
				{
					
		?>
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-thumb-tack mr-3" style="color:#f9d44c"  aria-hidden="true" ></i><a style="color:#fff" href="https://www.google.com/maps/place/Panchkula,+Haryana/@30.7026265,76.7798488,12z/data=!3m1!4b1!4m6!3m5!1s0x390f936ed6a2b757:0x898668d7061b40f0!8m2!3d30.6942091!4d76.860565!16zL20vMDk4MHB2?entry=ttu"><?php echo $social_result['location']; ?></a></p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i><?php echo $social_result['email']; ?></p>
                <p class="mb-0"><i class="fa fa-phone mr-3" style="color:#f9d44c"></i>+91 <?php echo $social_result['phone']; ?></p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" target="_blank" href="<?php echo $social_result['twitter_link']; ?>"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" target="_blank" href="<?php echo $social_result['facebook_link']; ?>"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" target="_blank" href="<?php echo $social_result['linkedin_link']; ?>"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square mr-2" target="_blank" href="<?php echo $social_result['instagram_link']; ?>"><i class="fab fa-instagram"></i></a>
							<a class="btn btn-primary btn-square" target="_blank" href="<?php echo $social_result['google_map_link']; ?>"><i class="fa fa-map"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
				}
			}
		 ?>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="#">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->
	
	<!-- Whatsapp icon Start -->
	<?php 
		include("whatsapp_file.php");
	?>

	<!-- Whatsapp icon End -->
	
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="assets/mail/jqBootstrapValidation.min.js"></script>
    <script src="assets/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>