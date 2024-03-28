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
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
			<div class="bg-light p-30 mb-5  border_bottom">
				<div class="row">
					<div class="col-md-6">
						 <img src="assets/img/place_order.png" alt="Image" class="img-fluid mr-3 mt-1" style="width:70px;"><span class="place_order_text"><b>Order placed, thank you!</b></span>
						<p class="mt-3"><b>Shipping To :- </b> <?php echo $product_name ?></p>
						<p class=""><b>Color :- </b> <?php echo $product_color ?></p>
						<p class=""><b>Size :-</b> <?php echo $product_size ?></p>
						<p class=""><b>Total Amount :- </b> <?php echo $all_amount ?></p>
					</div>
					<div class="col-md-6">
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
			</div>
        </div>
		<div class="col-md-4">
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

<!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
				  <?php 
						$sql2 = "SELECT * FROM product WHERE status = '1'";
						$result2 = $conn->query($sql2);
						if($result2->num_rows > 0)
						{
							while($row2 = $result2->fetch_assoc())
							{
							
					?>
                    <div class="product-item bg-light">
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
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="detail.php?product_id=<?php echo $row2['product_id'] ?>"><?php echo $row2['product_name'] ?></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5><?php echo  $row2['price'] ?></h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
					<?php 
							}
						}
					?>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
<!-- Footer Start -->
<?php 
    include('include/main_file/footer.php');
?>
<!-- Footer End -->


</body>
</html>
