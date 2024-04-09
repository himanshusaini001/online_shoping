 <!-- header Start -->
<?php 
// Include database Configuration And Connection
require_once('include/db_file/config.php');
require_once('include/db_file/connection_file.php');

// Redirect if user not logged in
if (!isset($_SESSION['customer_login'])) {
    header("location: customer_login.php");
    exit; // It's a good practice to exit after redirecting
}

// Redirect if customer ID not set
if (!isset($_SESSION['customer_id'])) {
    header("location: shop.php");
    exit; // It's a good practice to exit after redirecting
}

include('include/main_file/topbar.php');
include('include/main_file/header.php');

// Get customer ID from session
$customer_id = $_SESSION['customer_id'];

// Select command to fetch products from cart
if ($customer_id != "") {
    $sql = "SELECT * FROM add_to_cart WHERE customer_id = '$customer_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row['customer_id'];
        $product_id = $row['product_id'];
        $stock = $row['stock'];
        $product_name = $row['cart_name'];
        $product_qty = $row['cart_qty'];
        $product_price = $row['cart_price'];
        $product_color = $row['cart_color'];
        $product_size = $row['cart_size'];
        $total_price = $row['total_price'];
        $order_type = 'cash';

        // Insert the selected product into the order list
        $place_order_sql = "INSERT INTO order_list (customer_id, product_id, product_name, product_qty, product_price, product_color, product_size, total_price, order_type) VALUES ('$customer_id', '$product_id', '$product_name', '$product_qty', '$product_price', '$product_color', '$product_size', '$total_price', '$order_type')";

        if ($conn->query($place_order_sql) === TRUE) {
            if ($product_qty <= $stock) {
                // Reduce stock quantity after placing the order
                $update_stock = $stock - $product_qty;
                $sql_update = "UPDATE product SET stock = '$update_stock' WHERE product_id = '$product_id'";
                
                if ($conn->query($sql_update) === TRUE) {
                    // Delete the product from the cart after placing the order
                    $delete_add_to_cart = "DELETE FROM add_to_cart WHERE customer_id = ?";
                    $stmt = $conn->prepare($delete_add_to_cart);
                    $stmt->bind_param("i", $customer_id);
                    
                    if ($stmt->execute()) {
                        // Redirect to the place order page after successful operation
                        echo "<script>window.location='place_order.php';</script>";
                    } else {
                        echo "After Place order Do Not Delete Cart";
                    }
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                $_SESSION['msg_error'] = "Oops! This product is out of stock.";
            }
        } else {
            echo "Error: " . $place_order_sql . "<br>" . $conn->error;
        }
    }
} else {
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
        <div class="col-lg-12">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
			<div class=" p-30 mb-5  border_bottom ">
				<div class="row">
					<div class="col-md-2  ml-3">
						 <img src="assets/img/place_order.png" alt="Image" class="img-fluid mr-3 mt-1" style="width:150px;">
					</div>
					<div class="col-md-4  ml-3">
						 <span class="place_order_text"><b>Order placed, thank you!</b></span>
						<span><p>"Thank you for your order! We appreciate your support and look forward to serving you again soon. Enjoy!"</p></span>
					</div>
				</div>
			</div>
        </div>
		<div class="col-md-4">
		</div>
    </div>
</div>
<!-- Checkout End -->


<!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col-md-12">
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
	<input type="hidden" name="customer_id" id="customer_id" value="<?php echo  $customer_id ?>">
<!-- Footer Start -->
<?php 
    include('include/main_file/footer.php');
?>
<!-- Footer End -->
</body>
</html>
