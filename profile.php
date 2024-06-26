	<?php 
		// Including configuration File
		require_once('include/db_file/config.php');

		// Including database connection file
		require_once('include/db_file/connection_file.php');

		// Including topbar file
		include('include/main_file/topbar.php');

		// Including header file
		include('include/main_file/header.php');

		// Redirecting to customer login page if session is not set
		if(!isset($_SESSION['customer_login']))
		{
			header("location: customer_login.php");
		}
	?>
	 <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
					<a class="breadcrumb-item text-dark" href="customer_orders.php">Orders</a>
                    <span class="breadcrumb-item active">Your Profile</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
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
                <div class=" bg-light p-30 profile_border">
                    <h1>My Account</h1>
					<div class="border_bottom mt-2"></div>
					<div id="content">
						<h5 class="mt-4"><i class="fa fa-align-right mr-4" aria-hidden="true"></i><b>Name :</b> <?php echo  $_SESSION['fname'] ?>  <?php echo  $_SESSION['lname'] ?></h5>
						<h5 class="mt-4"><i class="fa fa-envelope mr-4" aria-hidden="true"></i><b>E-mail :</b> <?php echo  $_SESSION['email'] ?></h5>
						<h5 class="mt-4"><i class="fa fa-phone-square mr-4" aria-hidden="true"></i><b>Phone :</b> <?php echo  $_SESSION['phone'] ?></h5>
						<h5 class="mt-4"><i class="fa fa-map-marker mr-4" aria-hidden="true"></i><b>Address :</b> <?php echo  $_SESSION['address'] ?></h5>
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