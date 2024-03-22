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
    
   
	
	$qut = $_GET['qut'];
	$product_name = $_GET['product_name'];
	$all_amount = $_GET['all_amount'];
	$product_id = $_GET['product_id'];
	
?>
<!-- header End -->

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
				$user_id = $_SESSION['customer_id'];
				
				$sql = "SELECT * FROM user  WHERE sid = '$user_id'";
				
				$result =  $conn->query($sql);
				if($result->num_rows > 0)
				{
					while($row = $result->fetch_assoc())
					{
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
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <div class="d-flex justify-content-between">
                            <p>Product Name (<?php echo $qut ?> items)</p>
                            <p><?php echo $product_name ?></p>
                        </div>
                    </div>
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
         var errors = [];

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

        var nameRegex = /^[a-zA-Z]+$/;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var phoneRegex = /^[0-9]+$/;
        var addressRegex = /^[a-zA-Z0-9\s,.'-]*$/;

        if (firstName === "") {
            errors.push("Please enter your first name.");
        } else if (!nameRegex.test(firstName)) {
            errors.push("Please enter a valid first name with only letters.");
        }

        if (lastName === "") {
            errors.push("Please enter your last name.");
        } else if (!nameRegex.test(lastName)) {
            errors.push("Please enter a valid last name with only letters.");
        }

        if (city === "") {
            errors.push("Please enter your city name.");
        } else if (!nameRegex.test(city)) {
            errors.push("Please enter a valid city name with only letters.");
        }

        if (email === "") {
            errors.push("Please enter your email address.");
        } else if (!emailRegex.test(email)) {
            errors.push("Please enter a valid email address.");
        }

        if (phone === "") {
            errors.push("Please enter your phone number.");
        } else if (!phoneRegex.test(phone)) {
            errors.push("Please enter a valid phone number with only digits.");
        }

        if (addressLine1 === "") {
            errors.push("Please enter your address line 1.");
        } else if (!addressRegex.test(addressLine1)) {
            errors.push("Please enter a valid address line 1.");
        }
		
		if (addressLine2 === "") {
            errors.push("Please enter your address line 2.");
        } else if (!addressRegex.test(addressLine1)) {
            errors.push("Please enter a valid address line 2.");
        }
		
		if (country === "") {
            errors.push("Please enter your country .");
        } else if (!addressRegex.test(addressLine1)) {
            errors.push("Please enter a valid country .");
        }
		
		if (state === "") {
            errors.push("Please enter your state .");
        } else if (!addressRegex.test(addressLine1)) {
            errors.push("Please enter a valid state .");
        }
		if (pinCode === "") {
            errors.push("Please enter your pinCode .");
        } else if (!addressRegex.test(addressLine1)) {
            errors.push("Please enter a valid pinCode .");
        }

        // Repeat the same pattern for other fields

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
		else{
			// AJAX to submit form data
        var form = document.getElementById('addUserForm');
        let formdata = new FormData(form);
        $.ajax({
            type: "POST",
            url: "functions/function_ajax.php", // Replace with the actual server-side processing script
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
				var resp = JSON.parse(response);
                if (resp.status) {
					var product_id = document.getElementById('product_id').value;
					var all_amount = document.getElementById('all_amount').value;
					var qut = document.getElementById('qut').value;
					var order_type = document.getElementById('order_type').value;
					console.log(order_type);
					
                    // Redirect to another page after successful insertion
					//alert("data insert ok");
                    window.location.href = "place_order.php?product_id=" + encodeURIComponent(product_id) + "&all_amount=" +  encodeURIComponent(all_amount)  + "&qut=" +  encodeURIComponent(qut) + "&order_type=" +  encodeURIComponent(order_type);
                } else {
                    alert("Error: " + response);
                }
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed: " + status + "\nError: " + error);
            }
        });
		}
    }

</script>
</body>
</html>
