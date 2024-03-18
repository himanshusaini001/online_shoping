	<!-- header Start -->
	<?php 
		require_once('include/db_file/config.php');

		include('include/main_file/topbar.php');
		include('include/main_file/header.php');
		
	?>

	<!-- header End -->

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
                    <iframe style="width: 100%; height: 250px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
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
    $('form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        var error = false;

        // First Name and Last Name validation
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var nameRegex = /^[a-zA-Z\s]*$/; // Allow only alphabets and spaces

        if (!nameRegex.test(fname) || !nameRegex.test(lname)) {
            alert('Please enter valid first and last names (no numbers or special characters allowed).');
            error = true;
        }

        // Email validation
        var email = $('#email').val();
        var emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;

        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            error = true;
        }

        // Phone number validation
        var phone = $('#phone').val();
        var phoneRegex = /^\d{10}$/; // 10 digits only

        if (!phoneRegex.test(phone)) {
            alert('Please enter a 10-digit phone number.');
            error = true;
        }

        if (!error) {
            // If no validation error, proceed with AJAX form submission
			var form = document.getElementById('addForm');
			let formdata = new FormData(form);
            $.ajax({
                type: 'POST',
                url: "functions/function_ajax.php", // Replace with the actual server-side processing script
				data: formdata,
				processData: false,
				contentType: false,
                success: function(response) {
                    var res = JSON.parse(response);
					if (res.status) {
                           window.location = window.location.origin+"online-shoping/index.php" ;
                        } else {
                            alert("Error: Not Relocate");
                        }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('An error occurred while submitting the form. Please try again later.');
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
</script>
</body>

