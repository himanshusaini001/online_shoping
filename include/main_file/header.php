<?php 
if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] !='' )
{
$customer_id = $_SESSION['customer_id'];
$cart_data_sql = "SELECT * FROM add_to_cart WHERE customer_id = '$customer_id'";
$cart_data = $conn->query($cart_data_sql);
$cart_data_row = $cart_data->num_rows;
}
else
{
$cart_data_row = 0;
}

?>


<!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 80px; padding: 0 30px;">
                   <img class="logo" src="assets/img/online_shoping.png">
					<h4>LuxeAlign</h4>
                    
                </a>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <!--a href="detail.php" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.php" class="dropdown-item">Checkout</a>
                                </div>
                            </div-->
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>  
						<img class="add_to_cart" onclick="cart_page()" style="width:4%;" src="assets/img/add_to_cart.png" >
						<h4 style="color:#fff"><?php echo $cart_data_row ?></h4>
						<div class="nav-item dropdown">

						<?php 
							if(isset($_SESSION['customer_login']))
							{
								
								?>
									<a href="#" class="nav-link logout_btn_none" data-toggle="dropdown"><i class="fa fa-user arrow_right" aria-hidden="true"></i></a>
								<?php 
							}
								else
								{
									
							?>
									<a href="#" class="nav-link dropdown-toggle logout_btn_none" data-toggle="dropdown">Account<i class="fa fa-angle-down arrow_right1 mt-1"></i></a>
							<?php 
								}
						?>
							<div class="dropdown-menu  bg-primary rounded-0 border-0 m-0">
								<a href="signup.php" class="dropdown-item login_btn_link">Register</a>
								<a href="customer_login.php" class="dropdown-item login_btn_link">Login</a>
								<?php 
								
									if(isset($_SESSION['customer_login']))
									{
								?>		
										<style>
										.login_btn_link{
											display :none;
										}
										
										</style>
										<a href="customer_orders.php" class="dropdown-item">Auount</a>
										<a href="customer_logout.php" class="dropdown-item">Logout</a>
								<?php
									}
								?>
							</div>
						</div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
	<script>
		function cart_page()
		{
			   window.location.href = "cart.php";
		}
	</script>