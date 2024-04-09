<?php 
    // Include necessary Files
    require_once('include/db_file/config.php');
	require_once('include/db_file/connection_file.php');
	
	// Check if the user is logged in, if not, redirect to login page
	
	if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // Exit after redirection to stop further execution
    }
	
	// Include topbar and header files
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');
?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
				<?php 
					// Retrieve the user ID from the session
					$user_id = $_SESSION['customer_id'];
					
					// SQL query to select user information from the 'user' table where 'sid' (assuming it's the session ID) matches
					$sql = "SELECT * FROM user  WHERE sid = '$user_id'";
					
					// Execute the SQL query
					$result =  $conn->query($sql);
					
					// Check if there are any rows returned from the query
					if($result->num_rows > 0) {
						// Loop through each row returned by the query
						while($row = $result->fetch_assoc()) {
							// Process each row (likely to display user information)
						
					?>
						<div class="bg-light p-30 mb-5">
							<form id="addUserForm" action="#" method="post">
								<div class="form-group">
									<label for="first_name">First Name:</label>
									<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo  $row['fname'] ?>" required>
									<div class="error"></div>
								</div>

								<div class="form-group">
									<label for="last_name">Last Name:</label>
									<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo  $row['lname'] ?>" required>
									<div class="error"></div>
								</div>

								<div class="form-group">
									<label for="email">Email:</label>
									<input type="email" class="form-control" id="email" name="email" value="<?php echo  $row['email'] ?>" required>
									<div class="error"></div>
								</div>

								<div class="form-group">
									<label for="phone">Phone:</label>
									<input type="number" class="form-control" id="phone" name="phone" value="<?php echo  $row['phone'] ?>" required>
									<div class="error"></div>
								</div>

								<div class="form-group">
									<label for="address_line_1">Address Line 1:</label>
									<input type="text" class="form-control" id="address_line_1" name="address_line_1" value="<?php echo  $row['address'] ?>" required>
									<div class="error"></div>
								</div>

								<div class="form-group">
									<label for="address_line_2">Address Line 2:</label>
									<input type="text" class="form-control" id="address_line_2" name="address_line_2">
								</div>

								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="country">Country:</label>
										<select class="form-control" id="country" name="country" required>
											<option value="">Select Country</option>
											<option value="USA">india</option>
											<option value="Canada">Canada</option>
											<option value="UK">United Kingdom</option>
											<!-- Add more options as needed -->
										</select>
										<div class="error"></div>
									</div>
									<div class="form-group col-md-4">
										<label for="city">City:</label>
										<input type="text" class="form-control" id="city" name="city" required>
										<div class="error"></div>
									</div>
									<div class="form-group col-md-4">
										<label for="state">State:</label>
										<select class="form-control" id="state" name="state" required>
											<option value="">Select State</option>
											<option value="NY">punjab</option>
											<option value="CA">haryana</option>
											<option value="TX">himachal</option>
											<!-- Add more options as needed -->
										</select>
										<div class="error"></div>
									</div>
								</div>

								<div class="form-group">
									<label for="pin_code">Pin Code:</label>
									<input type="number" class="form-control" id="pin_code" name="pin_code" required>
									<div class="error"></div>
								</div>
								<input type="hidden" class="form-control"  name="action" value="billing_address" required>
								<input type="hidden" class="form-control" id="product_id"  name="product_id" value="<?php echo  $product_id ?>" required>
								<input type="hidden" class="form-control" id="all_amount"  name="all_amount" value="<?php echo  $all_amount ?>" required>
								<input type="hidden" class="form-control" id="qut"  name="qut" value="<?php echo  $qut ?>" required>
							</form>
						</div>
					<?php
					}
				}
			
			?>
			
        </div>
        <div class="col-lg-4">
		<?php 
			// Retrieve the customer ID from the session
			$customer_id = $_SESSION['customer_id'];
			
			// SQL query to select all records from 'add_to_cart' table where 'customer_id' matches the current customer's ID
			$sql_total = "SELECT * FROM add_to_cart WHERE customer_id = '$customer_id'";
			
			// Initialize variables to hold total amount and quantity
			$total_amount = 0;
			$total_qut = 0;
			
			// Execute the SQL query
			$result_num = $conn->query($sql_total);
			
			// Check if there are any rows returned from the query
			$cart_result_num_row = $result_num->num_rows;
			
			// If there are rows in the result set
			if ($cart_result_num_row > 0) {
				// Loop through each row of the result set
				while ($result = $result_num->fetch_assoc()) {
					// Add the total price of each item to the total amount
					$total_amount += $result['total_price'];
					
					// Add the quantity of each item to the total quantity
					$total_qut += $result['cart_qty'];
				}
			}
		?>

            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
						<div class="d-flex justify-content-between mt-2">
                            <h5>items</h5>
                            <h5><?php echo  $cart_result_num_row ?></h5>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php echo  $total_amount ?></h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="order_type" name="order_type"  class="custom-control-input" value="cash" checked>
                                <label class="custom-control-label" for="banktransfer">Cash on Delivery</label>
                            </div>
                        </div>
                        <button onclick="place_order()" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>
                </div>
        </div>
    </div>
</div>
<!-- Checkout End -->

<!-- Footer Start -->
<?php 
    include('include/main_file/footer.php');
?>
<!-- Footer End -->

<script>
    function place_order() {
		try{
			// Initialize an array to store validation errors
			var errors = [];
			
			// Retrieve values of form fields
			var firstName = document.getElementById('first_name').value.trim();
			var lastName = document.getElementById('last_name').value.trim();
			var city = document.getElementById('city').value.trim();
			var email = document.getElementById('email').value.trim();
			var phone = document.getElementById('phone').value.trim();
			var addressLine1 = document.getElementById('address_line_1').value.trim();
			var addressLine2 = document.getElementById('address_line_2').value.trim();
			var country = document.getElementById('country').value.trim();
			var state = document.getElementById('state').value.trim();
			var pinCode = document.getElementById('pin_code').value.trim();

			// Regular expressions for form field validation
			var nameRegex = /^[a-zA-Z]+$/;
			var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			var phoneRegex = /^[0-9]+$/;
			var addressRegex = /^[a-zA-Z0-9\s,.'-]*$/;

			// Validate each form field and push any errors to the errors array
			if (firstName === "") {
				errors.push("Please enter your first name.");
			} else if (!nameRegex.test(firstName)) {
				errors.push("Please enter a valid first name with only letters.");
			}

			// Repeat the validation process for other form fields...

			// If there are validation errors, prevent form submission and display errors
			if (errors.length > 0) {
				event.preventDefault(); // Prevent form submission
				alert(errors.join("\n")); // Display validation errors
			}
			else {
				// If there are no validation errors, proceed with form submission using AJAX
				
				// Create a FormData object to store form data
				var form = document.getElementById('addUserForm');
				let formdata = new FormData(form);
				
				// Send AJAX request to server-side script for form processing
				$.ajax({
					type: "POST",
					url: "functions/function_ajax.php", // Replace with the actual server-side processing script URL
					data: formdata, // Send form data
					processData: false,
					contentType: false,
					success: function (response) {
						// Parse the response as JSON
						var resp = JSON.parse(response);
						if (resp.status) {
							// If the response indicates success, redirect to another page
							var product_id = document.getElementById('product_id').value;
							var qut = document.getElementById('qut').value;
							var order_type = document.getElementById('order_type').value;
							console.log(order_type);
							window.location.href = "place_order.php"; // Redirect to place_order.php
						} else {
							// If the response indicates an error, display the error message
							alert("Error: " + response);
						}
					},
					error: function (xhr, status, error) {
						// If AJAX request fails, display error message
						alert("AJAX request failed: " + status + "\nError: " + error);
					}
				});
			}
		} catch (error) {
			// Catch and log any errors that occur during form submission
			console.error("Error occurred:", error);
		}
    }
</script>

</body>
</html>
