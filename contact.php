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
                    <div id="success"></div>
                    <form name="contactForm" onsubmit="return validateForm()" action="" method="post">
						<h2>Application Form</h2>
						<div class="row">
							<label>First Name</label>
							<input type="text"  class="form-control" name="fname">
							<div class="error" id="fnameErr"></div>
						</div>
						<div class="row">
							<label>Last Name</label>
							<input type="text"  class="form-control" name="lname">
							<div class="error" id="lnameErr"></div>
						</div>
						<div class="row">
							<label>Email Address</label>
							<input type="text"  class="form-control" name="email">
							<div class="error" id="emailErr"></div>
						</div>
						<div class="row">
							<label>Mobile Number</label>
							<input type="text"  class="form-control" name="mobile" maxlength="10">
							<div class="error" id="mobileErr"></div>
						</div>
						<div class="row">
							<label>message</label>
							   <textarea class="form-control" rows="8" id="message" name="message" placeholder="Message"></textarea>
							<div class="error" id="messageErr"></div>
						</div>
						<div class="row">
							<input class="btn btn-primary py-2 px-4" type="submit" value="Submit" >
							 
						</div>
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
	
	<!-- Footer End -->

<script>
 function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}

// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    let fname = document.contactForm.fname.value;
	let lname = document.contactForm.lname.value;
    let email = document.contactForm.email.value;
    let mobile = document.contactForm.mobile.value;
    let message = document.contactForm.message.value;
    
	// Defining error variables with a default value
    let fnameErr = lnameErr = emailErr = mobileErr = messageErr = true;
    
    // Validate fname
    if(fname == "") {
        printError("fnameErr", "Please enter your fname");
    } else {
        let regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(fname) === false) {
            printError("fnameErr", "Please enter a valid fname");
        } else {
            printError("fnameErr", "");
            fnameErr = false;
        }
    }
	
	// Validate lname
	if(lname == "") {
        printError("lnameErr", "Please enter your lname");
    } else {
        let regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(lname) === false) {
            printError("lnameErr", "Please enter a valid lname");
        } else {
            printError("lnameErr", "");
            lnameErr = false;
        }
    }
    
    // Validate email address
    if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        let regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }
    
    // Validate mobile number
    if(mobile == "") {
        printError("mobileErr", "Please enter your mobile number");
    } else {
		let regex = /^[1-9]\d{9}$/;       
        if(regex.test(mobile) === false) {
            printError("mobileErr", "Please enter a valid 10 digit mobile number");
        } else{
            printError("mobileErr", "");
            mobileErr = false;
        }
    }
	
	// Validate Message
	if(message == "") {
        printError("messageErr", "Please enter your message");
    } else {
        
        let regex = /^[a-zA-Z\s]+$/; 
        if(regex.test(message) === false) {
            printError("messageErr", "Please enter your  message");
        } else{
            printError("messageErr", "");
            messageErr = false;
        }
    }
    
    //
    
    // Prevent the form from being submitted if there are any errors
    if((nameErr || lnameErr ||  emailErr || mobileErr || messageErr ) == true) {
       return false;
    } else {
        // Creating a string from input data for preview
        let dataPreview = "You've entered the following details: \n" +
                          "Full Name: " + name + "\n" +
                          "Email Address: " + email + "\n" +
                          "Mobile Number: " + mobile + "\n" +
                          "Country: " + country + "\n" +
                          "Gender: " + gender + "\n";
        if(hobbies.length) {
            dataPreview += "Hobbies: " + hobbies.join(", ");
        }
        // Display input data in a dialog box before submitting the form
        alert(dataPreview);
    }
};
</script>
</body>

