<?php 
    // Include configuration file and necessary files
    require_once('include/db_file/config.php');
    require_once('include/db_file/connection_file.php');
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');
    
    // Check if customer is not logged in, then redirect to customer_login.php
    if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // Add exit after header redirect to stop further execution
    }
?>

	<!-- header End -->
	 <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <span class="breadcrumb-item active">Your Profile</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Detail Start -->
	<div class="container ">
	<h3>Your Orders</h3>
		<div class="row">
			<div class="col-md-12">
				<div class="order_bg">
					<div class="row">
					<div class="col-md-4">
						<a href="profile.php">
							<div class="order_box">
								<div class="row">
									<div class="col-md-4">
										<img class="address_img" src="<?php echo DTS_WS_SITE_IMG ?>profile.png" alt="Image">
									</div>
									<div class="col-md-8">
										<h6><b>My Profile</b></h6>
										<p>Check your Profile and address </p>
									</div>
								</div>
							</div>
						</a>
						</div>
						<div class="col-md-4">
						<a href="customer_order_history.php">
							<div class="order_box">
								<div class="row">
									<div class="col-md-4">
										<img class="order_img" src="<?php echo DTS_WS_SITE_IMG ?>order.png" alt="Image">
									</div>
									<div class="col-md-8">
										<h6><b>My Order</b></h6>
										<p>Track, return, or buy things again</p>
									</div>
								</div>
							</div>
						</a>
						</div>
						<div class="col-md-4">
						<a href="customer_address.php">
							<div class="order_box">
								<div class="row">
									<div class="col-md-4">
										<img class="address_img" src="<?php echo DTS_WS_SITE_IMG ?>address.png" alt="Image">
									</div>
									<div class="col-md-8">
										<h6><b>My Address</b></h6>
										<p>Edit address for orders and gifts</p>
									</div>
								</div>
							</div>
						</a>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
    <!-- Shop Detail End -->
	<!-- Footer Start -->.
	<?php 
		include('include/main_file/footer.php');
	?>
	
	<!-- Footer End -->
   


   
</body>

</html>