<?php 
	// Include configuration and connection files
	require_once('include/db_file/config.php');
	require_once('include/db_file/connection_file.php');
	
	// Check if the customer is not logged in, redirect to customer login page
	if(!isset($_SESSION['customer_login'])) {
		header("location: customer_login.php");
		exit; // Stop further execution
	}
	
	// If the customer is already logged in, display a message and redirect to the index page
	if(isset($_SESSION['customer_name'])) {
		echo '<script>alert("You are already registered."); window.location.href = "index.php";</script>';
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
                    <span class="breadcrumb-item active">Contact</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <form action="submit_form.php" method="POST" id="addForm">
                    <div class="form-group">
						<input type="hidden" class="form-control" id="fname" name="action" value="contact" required>
						
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
		<div class="col-lg-5 mb-5">
			<div class="bg-light p-30 mb-30">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27451.390202017803!2d76.84326653473477!3d30.6783506847033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390f9371c7ff1253%3A0xd576d663c8e12fda!2s134112!5e0!3m2!1sen!2sin!4v1710741098416!5m2!1sen!2sin" width="430" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<?php 
				$site_setting_query = "SELECT * FROM site_settings";
				$site_setting_result = $conn->query($site_setting_query);
				
				// Check if there are any results
				if ($site_setting_result->num_rows > 0) {
					$site_result = $site_setting_result->fetch_assoc();
					// Use $site_result for further processing
				} else {
					// Handle case when no settings are found
				}
			?>
			<div class="bg-light p-30 mb-3">
				<p class="mb-2"><i class="fa fa-map-marker contact_icon mr-3"></i><?php echo $site_result['location'] ?></p>
				<p class="mb-2"><i class="fa fa-envelope contact_icon mr-3"></i><?php echo $site_result['email'] ?></p>
				<p class="mb-2"><i class="fa fa-mobile contact_icon mr-3"></i>+91 <?php echo $site_result['phone'] ?></p>
			</div>
		</div> 
        </div>
    </div>
	
	
    <!-- Contact End -->


    <!-- Footer Start -->
	 
	<?php 
		include('include/main_file/footer.php');
	?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Footer End -->
<script>
$(document).ready(function() {
    // When the document is ready, set up a function to handle form submission
    $('form').submit(function(e) {
        try {
            e.preventDefault(); // Prevent the default form submission behavior
            
            var error = false; // Initialize error flag to false
            
            // First Name and Last Name validation
            var fname = $('#fname').val(); // Get the value of the first name field
            var lname = $('#lname').val(); // Get the value of the last name field
            var nameRegex = /^[a-zA-Z\s]*$/; // Regular expression to allow only alphabets and spaces
            
            // Check if both first name and last name match the regex pattern
            if (!nameRegex.test(fname) || !nameRegex.test(lname)) {
                alert('Please enter valid first and last names (no numbers or special characters allowed).');
                error = true; // Set error flag to true
            }
            
            // Email validation
            var email = $('#email').val(); // Get the value of the email field
            var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/; // Regular expression for email validation
            
            // Check if the email matches the regex pattern
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                error = true; // Set error flag to true
            }
            
            // Phone number validation
            var phone = $('#phone').val(); // Get the value of the phone number field
            var phoneRegex = /^\d{10}$/; // Regular expression for 10-digit phone number
            
            // Check if the phone number matches the regex pattern
            if (!phoneRegex.test(phone)) {
                alert('Please enter a 10-digit phone number.');
                error = true; // Set error flag to true
            }

            if (!error) {
                // If no validation error, proceed with AJAX form submission
                
                var form = document.getElementById('addForm'); // Get the form element
                let formdata = new FormData(form); // Create FormData object to store form data
                
                // AJAX request
                $.ajax({
                    type: 'POST',
                    url: "functions/function_ajax.php", // Replace with the actual server-side processing script
                    data: formdata, // Form data to be sent
                    processData: false, // Prevent jQuery from processing data
                    contentType: false, // Prevent jQuery from setting contentType
                    success: function(response) {
                        var res = JSON.parse(response); // Parse the JSON response
                        if (res.status) {
                            // If the status is true, redirect to the specified location
                            window.location = window.location.origin + "/online-shoping/index

</script>
</body>

