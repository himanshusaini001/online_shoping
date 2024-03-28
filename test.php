<!-- header Start -->
<?php 
    require_once('include/db_file/config.php');
	require_once('include/db_file/connection_file.php');
	 if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // It's a good practice to exit after redirecting
    }
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');
	
	
	 // Get Data Start
    
	$product_id = $_GET['product_id'];
	$all_amount = $_GET['all_amount'];
	$_SESSION['customer_order_history_id'] = $product_id;
	$_SESSION['customer_order_amount'] = $all_amount;
	 // Get Data End
	 
	 // Select Command Start
	 if($product_id != "")
	 {
		$sql = "SELECT * FROM product WHERE product_id = '$product_id'";
		
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();	
		$stock = $row['stock'];
		$product_id1 = $row['product_id'];	
		$product_color = $row['product_color'];	
		$product_size = $row['product_size'];	
		$product_name = $row['product_name'];	
		$all_amount = $_GET['all_amount'];
		$product_qut = $_GET['qut'];
		$order_type = $_GET['order_type'];
		
		if($product_id == $product_id1 )
		{
			
			$place_order_sql = "INSERT INTO place_order_list(order_id, order_name, order_color,order_size,order_qut,order_amount,order_type) VALUE('$product_id1','$product_name','$product_color','$product_size','$product_qut','$all_amount','$order_type')";
			
			if ($conn->query($place_order_sql) === TRUE) {
				
					if($product_qut <= $stock)
					{
							if(isset($_GET['qut']) == true)
							{
								
								$update_stock = $stock - $product_qut;
								$sql_update = "	UPDATE product SET stock = '$update_stock' WHERE product_id = '$product_id'";
								
									if ($conn->query($sql_update) === TRUE) {
										echo '<style>
											.block_out_off_stock1{
												display:none;
											}
										</style>';
									} else {
									  echo "Error updating record: " . $conn->error;
									}

							}
							$sql = "SELECT * FROM product WHERE product_id = '$product_id'";
							
							$result = $conn->query($sql);
							
							$row = $result->fetch_assoc();	
							$_SESSION['msg'] = "Successfull Your order";
					}
					else{
							echo '<style>
								.block_out_off_stock{
									display:none;
								}
							</style>';
							$_SESSION['msg_error'] = "Opps ! This product is out off stock ";
					}
					// Check shock Condation End
						} else {
						  echo "ok insert not";exit;
						}

		
		}
		else{
			echo "Do not ID Same";
		}
		// Select Command End
		
		// Check shock Condation start
		
	 }
	 else
	 {
		echo "<script>alert('Do Not fetch id'); window.location.href = 'index.php';</script>";
	 }
	
	
	
	
?>
<!-- header End -->
<style>
.active_id {
	background-color: #a4e9a4;
	padding: 10px;
	color:#000;
}
.Inactive_id {
	background-color: #ed6060;
	padding: 10px;
	color:#fff;
}
</style>
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                <span class="breadcrumb-item active">Place Order</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->
<div class="container-fluid block_out_off_stock">
    <div class="row px-xl-5">
        <div class="col-lg-8  "   >
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
           
			<div class="bg-light p-30 mb-5  border_bottom">
				 <img src="assets/img/place_order.png" alt="Image" class="img-fluid mr-3 mt-1" style="width: 100px;"><span class="place_order_text">Order placed, thank you!</span>
			</div>
			<div class="bg-light p-5 ">
				<h2>Your Order</h2>
				<div class="row">
					<div class="col-md-6">
						<div class="mt-5">
							 <?php 
								// Check if there are images for this product
								if (!empty($row['product_img'])) {
									$images = explode(",", $row['product_img']);
									foreach ($images as $key=>$image) {
										if($key == '0')
										{
											echo "<img src='upload_img/$image' width='250px' height='250px'>";
										}
										
									}
								}
								?>
						</div>
					</div>
					<div class="col-md-6">
						<h5>Order Id : <?php echo  $row['product_id'] ?></h5>
						<h5>Name : <?php echo  $row['product_name'] ?></h5>
						<h5>color : <?php echo $row['product_color'] ?></h5>
						<h5>Size : <?php echo  $row['product_size'] ?></h5>
					</div>
				</div>
			</div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <!--div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <div class="d-flex justify-content-between">
                            <p>Product Name (<?php echo $qut ?> items)</p>
                            <p><?php echo $product_name ?></p>
                        </div>
                    </div-->
                    <!--div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div-->
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php echo  $all_amount ?></h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer" checked>
                                <label class="custom-control-label" for="banktransfer">Cash on Delivery</label>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
<div class="container-fluid  block_out_off_stock1">
	<div class="container ">
		<?php 
			include("admin/include/main_file/flash_message.php");
		?>
		<div class="row px-xl-5  bg-light p-30 mb-5  border_bottom">
			<div class="col-lg-12">
				<h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Sorry !</span></h5>
				<?php 
					include("admin/include/main_file/flash_message.php");
				?>
				<div class="">
					<span class="place_order_text mr-5" >After Avaliable product i will Sand Message Your G-mail</span> <span><a href="shop.php" class=" btn btn-primary  shop_button ">Continue Shop</a></span>
				</div>
				
			</div>
		</div>
	</div>
</div>
<!-- Footer Start -->
<?php 
    include('include/main_file/footer.php');
?>
<!-- Footer End -->


</body>
</html>
