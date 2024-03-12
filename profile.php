	<!-- header Start -->
	
	<?php 
		require_once('include/db_file/config.php');

		include('include/main_file/topbar.php');
		include('include/main_file/header.php');
		
		if(!isset($_SESSION['customer_login']))
		{
			header("location: customer_login.php");
		}
	?>
	<!-- header End -->
	
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?php echo DTS_WS_SITE_IMG ?>product-1.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30 profile_border">
                    <h1>Your Account</h1>
					<div id="content" >
					
					<h5 class="mt-4"><i class="fa fa-align-right mr-4" aria-hidden="true"></i><b>Name :</b> <?php echo  $_SESSION['fname'] ?>  <?php echo  $_SESSION['lname'] ?></h5>
					<h5 class="mt-4"><i class="fa fa-envelope mr-4" aria-hidden="true"></i><b>E-mail :</b> <?php echo  $_SESSION['email'] ?>  <?php echo  $_SESSION['lname'] ?></h5>
					<h5 class="mt-4"><i class="fa fa-phone-square mr-4" aria-hidden="true"></i><b>Phone :</b> <?php echo  $_SESSION['phone'] ?>  <?php echo  $_SESSION['lname'] ?></h5>
					<h5 class="mt-4"><i class="fa fa-map-marker mr-4" aria-hidden="true"></i><b>Address :</b> <?php echo  $_SESSION['address'] ?>  <?php echo  $_SESSION['lname'] ?></h5>
					
				
            </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Shop Detail End -->



<!-- Footer Start -->
	 
	<?php 
		include('include/main_file/footer.php');
	?>
	
	<!-- Footer End -->
   


   
</body>

</html>