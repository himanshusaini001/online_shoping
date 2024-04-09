<!-- header Start -->
<?php 
	// Include configuration and connection Files
    require_once('include/db_file/config.php');
    require_once('include/db_file/connection_file.php');
	
    // Check if customer is logged in, if not, redirect to login page
	if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // Add exit after header redirect to stop further execution
    }
    
    // Include topbar and header files
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');
?> 

<style>
    .error {
        color: red;
    }
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
<!-- header End -->

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
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="address_bg">
                <h6><b>Default :</b>  Online Shopping</h6>
                <div class="border_bottom mb-3 mt-1"></div>
				
                <form id="countryForm">
                    <div class="row">
                        <div class="col-md-6">
							
							<label for="fullname">Country:</label><br>
                            <input type="text" class="form-control" id="country" name="country"><br>
                            <span class="error" id="countryError"></span><br>

                            <label for="fullname">Full Name:</label><br>
                            <input type="text" class="form-control" id="fullname" name="fullname"><br>
                            <span class="error" id="fullNameError"></span><br>

                            <label for="phone">Phone:</label><br>
                            <input type="text" class="form-control" id="phone" name="phone"><br>
                            <span class="error" id="phoneError"></span><br>

                            <label for="pincode">Pincode:</label><br>
                            <input type="text" class="form-control" id="pincode" name="pincode"><br>
                            <span class="error" id="pincodeError"></span><br>
                            
                            <label for="house">House/Flat No/Full Address:</label><br>
                            <input type="text" class="form-control" id="house" name="house"><br>
                            <span class="error" id="houseError"></span><br>
                            
                        </div>
                        <div class="col-md-6">
							 <label for="delivery">Delivery instructions (optional):</label><br>
								<select class="form-control" id="delivery" name="delivery">
									<option value="House">House</option>
									<option value="Apartment">Apartment</option>
									<option value="Business">Business</option>
									<option value="Other">Other</option>
								</select><br>
								<span class="error" id="deliveryError"></span><br>
								
                            <label for="street">Street:</label><br>
                            <input type="text" class="form-control" id="street" name="street"><br>
                            <span class="error" id="streetError"></span><br>

                            <label for="landmark">Landmark:</label><br>
                            <input type="text" class="form-control" id="landmark" name="landmark"><br>
                            <span class="error" id="landmarkError"></span><br>
                            
                            <label for="town">Town:</label><br>
                            <input type="text" class="form-control" id="town" name="town"><br>
                            <span class="error" id="townError"></span><br>
                            
                            <label for="state">State:</label><br>
                            <input type="text" class="form-control" id="state" name="state"><br>
                            <span class="error" id="stateError"></span><br>
                            <button type="submit" class="btn btn-primary customer_address_btn" style="float:right">Add Address</button>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="action" name="action" value="add_address"><br>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="address_bg " style=" height:335px; overflow: auto;" >
                <h6><b>Default :</b>  View Address</h6>
                <div class="border_bottom mb-3 mt-1"></div>
                <?php 
					if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != '' ) {
						// If customer is logged in, retrieve their address details
						$customer_id = $_SESSION['customer_id'];
						$sql = "SELECT * FROM customer_address WHERE customer_id = '$customer_id' ";
						$address_row = $conn->query($sql);
						if ($address_row->num_rows > 0) { // Checking if there are any rows returned
							while($address_result = $address_row->fetch_assoc()) {
								?>
								<!-- Displaying address details using Bootstrap card -->
								<div class="card mt-2" style="width: 18rem;"  >
									<div class="card-body " >
										<h5 class="card-title"><?php echo $address_result['full_name']; ?></h5>
										<p class="card-text"><b>LandMark : </b><?php echo $address_result['house_no']; ?></p>
										<p class="card-text"><b>Phone : </b><?php echo $address_result['phone']; ?></p>
										<p class="card-text"><b>State : </b><?php echo $address_result['state']; ?></p>
									</div>
								</div>
								<?php
								// Replace 'address_field' with the actual field you want to display
							}
						} else {
							echo "<h3>Sorry! Please Add your Address</h3>";
						}
					} else {
						echo "<h3>Sorry! Please Add your Address</h3>";
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

<script>
$(document).ready(function() {
    $('#countryForm').submit(function(e) {
        try {
            e.preventDefault(); // Prevent default form submission
            
            var isValid = true; // Flag to track form validity
            
            // Validation for country
            var country = $('#country').val();
            if (country.trim() === '') {
                $('#countryError').text('Please enter your country.');
                isValid = false;
            } else {
                $('#countryError').text('');
            }
            
            // Validation for full name
            var fullname = $('#fullname').val();
            if (fullname.trim() === '') {
                $('#fullNameError').text('Please enter your full name.');
                isValid = false;
            } else {
                $('#fullNameError').text('');
            }
            
            // Validation for phone number
            var phone = $('#phone').val();
            var phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phone)) {
                $('#phoneError').text('Please enter a valid phone number (10 digits).');
                isValid = false;
            } else {
                $('#phoneError').text('');
            }
            
            // Additional validations for other form fields...
            
            // If all validations pass
            if (isValid) {
                // AJAX request to submit form data
                var form = document.getElementById('countryForm');
                var formdata = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "functions/function_ajax.php", // URL to server-side processing script
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        var resp = JSON.parse(response);
                        if (resp.status) {
                            // Redirect to another page after successful insertion
                            window.location.href = "customer_address.php";
                        } else {
                            alert("Error: " + response);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("AJAX request failed: " + status + "\nError: " + error);
                    }
                });
            }
        } catch (error) {
            console.error("Error occurred:", error);
        }
    });
});
</script>

   
</body>

</html>