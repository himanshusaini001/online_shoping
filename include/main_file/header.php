<!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"></i>LOGO</h6>
                    
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
                            <a href="detail.php" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.php" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
						<div class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle logout_btn_none" data-toggle="dropdown">Register/Login <i class="fa fa-angle-down mt-1"></i></a>
							<div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
								<a href="admin/registration.php" class="dropdown-item login_btn_link">Register</a>
								<a href="admin/login.php" class="dropdown-item login_btn_link">Login</a>
								<?php 
								
									if(isset($_SESSION['admin']))
									{
								?>		
										<style>
										.login_btn_link{
											display :none;
										}
										
										</style>
										<a href="admin/logout.php" class="dropdown-item">Logout</a>
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