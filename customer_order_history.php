<?php 
    require_once('include/db_file/config.php');
    require_once('include/db_file/connection_file.php');
    if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // Add exit after header redirect to stop further execution
    }

    include('include/main_file/topbar.php');
    include('include/main_file/header.php');

    if(!isset($_SESSION['customer_id']) ) {
		$order = $_SESSION['order_id'] = "No Order";
		
    }
	else{
		$order = $_SESSION['order_id'] = " order";
	}
?>

<style>
    .error {
        color: red;
    }
    .active_id {
        background-color: #a4e9a4;
        padding: 10px;
        color: #000;
    }
    .Inactive_id {
        background-color: #ed6060;
        padding: 10px;
        color: #fff;
    }
</style>

<!-- header End -->
<?php 
if($order == "No Order") {
?>
   <div class="container-fluid ">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30 ">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
				<a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                <span class="breadcrumb-item active">Your Orders</span>
            </nav>
			<?php 
				include("admin/include/main_file/flash_message.php");
			?>
        </div>
		
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Detail Start -->
<div class="container">
    <div class="row">
        <div class="col-md-12 order_history_box" >
			<div class="row">
				<div class="col-md-6">
					<h2>Sorry ! No Orders</h2>
				</div>
				<div class="col-md-6">
					<a class="arrow-link home_button" href="shop.php" style="color:#3d464d">Continue Shopping</a>
				</div>
			</div>
		</div>
    </div>
</div>
<?php 
} else {
?>
   
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
				<a class="breadcrumb-item text-dark" href="customer_orders.php">Orders</a>
                <span class="breadcrumb-item active">Your Address</span>
            </nav>
			<?php 
				include("admin/include/main_file/flash_message.php");
			?>
        </div>
		
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Detail Start -->
<div class="container " >
    <div class="row">
        <div class="col-md-8"style="height: 400px; overflow: auto; "  >
			<h5><b>Order :-</b></h5>
			<?php 
				$customer_id = $_SESSION['customer_id'];
				$customer_histor = "SELECT * FROM order_list WHERE customer_id='$customer_id' ";
				$customer_histor_row = $conn->query($customer_histor);
				
				if($customer_histor_row->num_rows > 0)
				{
					while($customer_histor_result = $customer_histor_row->fetch_assoc())
					{
			?>
            <div class="order_history_box mb-4"  >
					<div class="row" >
						<div class="col-md-4">
							<h6><b>Total Amount : </b><?php echo $customer_histor_result['total_price']  ?><h6>
						</div>
						<div class="col-md-4">
							<h6><b>Ship To : </b><?php echo $customer_histor_result['product_name']  ?><h6>
						</div>
						<div class="col-md-4">
							<h6><b>Order Id : </b><?php echo $customer_histor_result['product_id']  ?><h6>
							<a class="arrow-link" href="cart.php	" style="color:#3d464d">View Order Detail</a>
						</div>
						<div class="border_bottom mt-2"></div>
						<div>
							<h4 class="mt-3"><b>Delivered 00-00-2024</b></h4>
							<p>Package was handed to resident</p>
							<div class="row">
								<div class="col-md-3">
									<?php 
										// Check if there are images for this product
										if (!empty($customer_histor_result['product_img'])) {
											$images = explode(",", $customer_histor_result['product_img']);
											foreach ($images as $key=>$image) {
												if($key == '0')
												{
													echo "<img src='upload_img/$image' width='100px' height='100px'>";
												}
												
											}
										}
										?>
								</div>
								<div class="col-md-6">
									<h6><b>Return window closed on 10-Feb-2024</b></h6>
									<p>Return window closed on 10-Feb-2024</p>
								</div>
								<div class="col-md-3">
									<div>
										<a href="" class="customer_history_button mb-2">Random</a>
									</div>
									<div class="mt-3">
										<a href="" class="customer_history_button mb-2">Random</a>
									</div>
									<div class="mt-3">
										<a href="" class="customer_history_button mb-2">Random</a>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<?php 
					
					}
				}
				
			?>
        </div>
        <div class="col-md-4">
			<h5><b>Buy it again :-</b></h5>
            <div class=" product_box" style="height: 323px; overflow: auto;" >
				<?php 
					$product_box = "SELECT * FROM product";
					$product_box_row = $conn->query($product_box);
					if($product_box_row->num_rows > 0)
					{
						while($product_box_result = $product_box_row->fetch_assoc())
						{ 
					?>
						<div class="card" >
						<?php 
							// Check if there are images for this product
							if (!empty($product_box_result['product_img'])) {
								$images = explode(",", $product_box_result['product_img']);
								foreach ($images as $key=>$image) {
									if($key == '0')
									{
										echo "<img src='upload_img/$image' width='100px' height='100px'>";
									}
									
								}
							}
							?>
						  <h5><?php echo $product_box_result['product_name'] ?></h5>
						  <p class="title"><?php echo $product_box_result['price'] ?></p>
						  <p>Harvard University</p>
						
						  <a href="cart.php?product_id=<?php echo $product_id ?>" class="loop_product">Add To Cart</a>
						</div>
					<?php
						}
					}
					
				?>
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
<?php
}
?>

</body>
</html>
