<?php 
    // Include necessary files for database connection File
    require_once('include/db_file/config.php'); 
    require_once('include/db_file/connection_file.php');
    
    // Check if the customer is logged in, if not, redirect them to the login page
	if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // Add exit after header redirect to stop further execution
    }

    // Get the customer ID from the session
		$customer_id = $_SESSION['customer_id'];
    // Include topbar and header files
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');
	 
	 // Initialize total_price variable
	$total_price = 0; // You may initialize this with a value if needed
	
?> 

<!-- header Start -->

<!-- header End -->

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Remove</th>
                    </tr>
				
                </thead>
                <tbody class="align-middle">
					<?php 
						// SQL query to select all records from 'add_to_cart' table where customer_id matches
						$sql = "SELECT * FROM add_to_cart WHERE customer_id='$customer_id'";
						
						// Execute the SQL query
						$result = $conn->query($sql);
						
						// Initialize a variable to hold the total amount
						$total_amount = 0;
						
						// Check if there are any records returned from the query
						if($result->num_rows > 0) {
							// Loop through each row returned by the query
							while($row = $result->fetch_assoc()) {
								// Add the total price of each item to the total_amount variable
								$total_amount += $row['total_price'];

					?>

                    <tr>
                        <td class="align-middle"><img src="<?php echo DTS_WS_SITE_IMG ?>product-1.jpg" alt="" style="width: 50px;"> <?php echo $row['cart_name'] ?></td>
                        <td class="align-middle"><?php echo $row['cart_price'] ?></td>
							
						
						<td class="align-middle">
							<div class="input-group quantity mx-auto" style="width: 100px;">
								<div class="input-group-btn">
									<button class="btn btn-sm btn-primary btn-minus link1" id="btn_minus"
									data-product_id="<?php echo $row['product_id'] ?>"
									data-price="<?php echo $row['cart_price'] ?>"
									data-stock="<?php echo $row['stock'] ?>"
									data-cart_id="<?php echo $row['cart_id'] ?>"
									>
										<i class="fa fa-minus"></i>
									</button>
								</div>
								<input type="number" id="qut_change"  name="qut_change" min="1" max="5" class="form-control form-control-sm bg-secondary border-0 text-center qut_change" value="<?php echo $row['cart_qty'] ?>">
								<div class="input-group-btn">
									<button class="btn btn-sm btn-primary btn-plus link2"  id="btn_plus" 
									data-product_id="<?php echo $row['product_id'] ?>"
									data-price="<?php echo $row['cart_price'] ?>"
									data-stock="<?php echo $row['stock'] ?>"
									data-cart_id="<?php echo $row['cart_id'] ?>"
									>
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</td>
					
						
						<input type="hidden" id="price" name="price" value="<?php echo $row['cart_price'] ?>">
						<input type="hidden" id="product_id" name="product_id" value="<?php echo $row['product_id'] ?>">
						<input type="hidden" id="stock" name="stock" value="<?php echo $row['stock'] ?>">
					   <td class="align-middle" ><button class="btn btn-sm btn-danger" onclick="delete_cart_items(<?php echo $row['cart_id'] ?>)"><i class="fa fa-times"></i></button></td>
                    </tr>
					
		<?php	}
						}
					?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Amount</h6>
                        <h6 class="font-weight-medium total_amount" id="amount"><?php echo $total_amount ?></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 class="font-weight-medium all_amount" id="all_amount" ><?php echo $total_amount ?></h5>
						<input type="hidden" id="total_price" name="total_price" value="<?php echo $total_amount ?>">
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" onclick="checkout()">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<!-- Footer Start -->
<?php 
    include('include/main_file/footer.php');
?>
<!-- Footer End -->
<script>
$(document).ready(function() {
    var totalAmount = parseInt($('#total_price').val()); // Get initial total amount
    $('.btn-minus').click(function() {
        // Decrease quantity of a product
        try {
            // Retrieve necessary data from the clicked button
            var price = parseInt($(this).data('price'));
            var product_id = parseInt($(this).data('product_id'));
            var cart_id = parseInt($(this).data('cart_id'));
            var qut = parseInt($(this).closest('tr').find('.qut_change').val());
            
            if (qut == 0) {
                // If quantity is 0, alert user and remove item from cart
                alert("Please Add Stock");
                totalAmount -= price;
                // Send AJAX request to remove item from cart
                $.ajax({
                    type: "POST",
                    url: "functions/function_ajax.php",
                    data: {
                        action: "add_to_cart_delete",
                        cart_id: cart_id
                    },
                    success: function(response) {
                        var resp = JSON.parse(response);
                        if (resp.status) {
                            window.location.href = "cart.php";
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading data: " + error);
                    }
                });
            } else {
                // If quantity is not 0, decrease total amount
                totalAmount -= price;
            }
            updateTotal(totalAmount);
        } catch (error) {
            console.error("Error occurred:", error);
        }
    });

    $('.btn-plus').click(function() {
        // Increase quantity of a product
        try {
            var price = parseInt($(this).data('price'));
            var qut = parseInt($(this).closest('tr').find('.qut_change').val());
            var stock = parseInt($(this).data('stock'));
            var cart_id = parseInt($(this).data('cart_id'));
            var product_id = parseInt($(this).data('product_id'));
            
            if (qut >= stock) {
                // If quantity is greater than or equal to stock, alert user
                alert("Only Available Stock: " + stock);
            } else {
                // If quantity is less than stock, increase total amount
                totalAmount += price;
            }
            updateTotal(totalAmount);
        } catch (error) {
            console.error("Error occurred:", error);
        }
    });

    function updateTotal(amount) {
        // Update total amount displayed on the page
        $('#all_amount').text(amount);
        $('#amount').text(amount);
        $('#total_amount_p').text(amount);
    }
});

function delete_cart_items(cart_id) {
    // Function to delete items from cart
    try {
        var cart_id = cart_id;
        // Send AJAX request to remove item from cart
        $.ajax({
            type: "POST",
            url: "functions/function_ajax.php",
            data: {
                action: "add_to_cart_delete",
                cart_id: cart_id
            },
            success: function(response) {
                var resp = JSON.parse(response);
                if (resp.status) {
                    window.location.href = "cart.php";
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading data: " + error);
            }
        });
    } catch (error) {
        console.error("Error occurred:", error);
    }
}

function checkout() {
    // Redirect user to checkout page
    window.location.href = "checkout.php";
}

</script>
</body>
</html>