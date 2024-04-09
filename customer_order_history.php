<?php 
    // Include configuration file and database Connection
    require_once('include/db_file/config.php');
    require_once('include/db_file/connection_file.php');
    
    // Redirect to customer login page if not logged in
    if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // Add exit after header redirect to stop further execution
    }

    // Include topbar and header files
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');

    // Set session variable for order
    if(!isset($_SESSION['customer_id'])) {
        $order = $_SESSION['order_id'] = "No Order"; // Set order to "No Order" if customer ID is not set
    } else {
		$order_list = "SELECT * FROM order_list WHERE customer_id = '$customer_id'";
		$executer_order = $conn->query($order_list);
		$order_row = $executer_order->num_rows;
		if($order_row == 0)
		{
			$order = $_SESSION['order_id'] = "No Order";
		}
		else{
			$order = $_SESSION['order_id'] = " order"; 
		}
        // Set order to "order" if customer ID is set
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
				// Retrieve customer ID from session
				$customer_id = $_SESSION['customer_id'];
				// Query to select order history for the current customer
				//$customer_history_query = "SELECT * FROM order_list WHERE customer_id='$customer_id' ";
				$customer_history_query ="SELECT product.product_img,product.product_img,order_list.total_price,order_list.product_name,order_list.product_id
				FROM product
				INNER JOIN order_list ON product.product_id = order_list.product_id WHERE customer_id = '$customer_id'";
 
				
				// Execute the query
				$customer_history_result = $conn->query($customer_history_query);
				
				// Check if there are any rows returned
				if($customer_history_result->num_rows > 0) {
					// Loop through the results and display each order
					while($customer_history_row = $customer_history_result->fetch_assoc()) {
			?>

            <div class="order_history_box mb-4"  >
					<div class="row" >
						<div class="col-md-4">
							<h6><b>Total Amount : </b><?php echo $customer_history_row['total_price']  ?><h6>
						</div>
						<div class="col-md-4">
							<h6><b>Ship To : </b><?php echo $customer_history_row['product_name']  ?><h6>
						</div>
						<div class="col-md-4">
							<h6><b>Order Id : </b><?php echo $customer_history_row['product_id']  ?><h6>
							<a class="arrow-link" href="cart.php	" style="color:#3d464d">View Order Detail</a>
						</div>
						<div class="border_bottom mt-2 mb-4"></div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<?php 
										// Check if there are images for this product
										if (!empty($customer_history_row['product_img'])) {
											$images = explode(",", $customer_history_row['product_img']);
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
									<h5><b>Lorem Ipsum</b></h5>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
								</div>
								<div class="col-md-3">
									<a href="" class="customer_history_button mb-2">Cancel Order</a>
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
					#fetch Data
					$product_box = "SELECT * FROM product";
					$product_box_row = $conn->query($product_box);//Execute Query
					if($product_box_row->num_rows > 0) // Fecth Num Rows
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
