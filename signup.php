<?php 
	include('include/db_file/config.php');
	if(isset($_SESSION['customer_login']))
	{
		header("location: index.php");
	}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags Start -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta Tags End -->
    
    <!-- Bootstrap Links Start -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="assets/css/front_style.css" rel="stylesheet">
    <!-- Bootstrap Links End -->
    
    <!-- Ajax Link Start -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Ajax Link End -->
    
    <!-- Title Start -->
    <title>Responsive Layout</title>
    <!-- Title End -->
    
    <style>
		#countdown{
			display:none;
		}
		.error {
		  color: red;
		}
		body {
		  background-color: #f8f9fa; /* Set background color */
		  padding: 20px;
		}
		.countdown-container {
		  text-align: center;
		  margin-top: 100px;
		}
		.countdown {
		  font-size: 4em;
		  font-weight: bold;
		  margin-bottom: 20px;
		}
		.countdown-animation {
		  animation: pulse 1s infinite alternate;
		}
		@keyframes pulse {
		  
			0% { 
				transform: scale(1);
				color:  #FFFFFF; 
			}
			
			
			100% {
				transform: scale(1.1);
				color: pink; 
			}
			
		}
	</style>
</head>

<!-- Body Start -->
<body>

<!-- HTML Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form id="addUserForm">
				
                <h1 class="mb-4 block_reg" >Sign Up</h1>
				
				
                <div class="row block_reg">
                    <div class="col-md-6">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="fname" name="fname" required>
						<div id="fnameError" class="error"></div>
						
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lname" name="lname" required>
						<div id="lnameError" class="error"></div>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
						<div id="emailError" class="error"></div>
                        
                        <label for="phone">Phone:</label>
                        <input type="number" id="phone" name="phone" pattern="[0-9]*" maxlength="10" required>
						<div id="phoneError" class="error"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="userAddress">Address:</label>
                        <input type="text" id="address" name="address" required>
						<div id="addressError" class="error"></div>

                        <label for="userUsername">Username:</label>
                        <input type="text" id="username" name="username" required>
						<div id="usernameError" class="error"></div>

                        <label for="userPassword">Password:</label>
                        <input type="text" id="password" name="password" required>
						<div id="passwordError" class="error"></div>

                        <button type="button" id="addUser" class="Register_btn">Register</button>
                    </div>
                </div>
            </form>
		<p id="countdown" class="countdown countdown-animation">Redirecting in 3 second...</p>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>


  
<!-- Result Section -->
<div id="result" class="result"></div>
<!-- Script Start -->
	<script>
		$(document).ready(function() {
			$("#addUser").click(function() {
				// Custom validation logic

				$(".error").text("");

				// Get input values
				
				var fname = $("#fname").val();
				var lname = $("#lname").val();
				var email = $("#email").val();
				var phone = $("#phone").val();
				var address = $("#address").val();
				var username = $("#username").val();
				var password = $("#password").val();

				// Validation
				if (!fname) 
				{
					$("#fnameError").text("First Name is required");
				}
				if (!lname) 
				{
					$("#lnameError").text("Last Name is required");
				}
				if (!isValidEmail(email)) 
				{
					$("#emailError").text("Invalid email format");
				}
				if (!isValidPhone(phone)) 
				{
					$("#phoneError").text("Invalid phone number");
				}
				if (!address) 
				{
					$("#addressError").text("Address is required");
				}
				if (!username) 
				{
					$("#usernameError").text("Username is required");
				}
				if (!isValidPassword(password)) 
				{
					$("#passwordError").text("Password must be at least 6 characters");
				}
				// If no validation errors, submit the form data using AJAX
				if ($(".error:empty").length === $(".error").length) 
				{
					$.ajax({
						type: "POST",
						url: "functions/function_ajax.php",
						data: 
						{
							action: "register",
							fname: fname,
							lname: lname,
							email: email,
							phone: phone,
							address: address,
							username: username,
							password: password
						},
					success: function(response) 
					{
						$("#result");

						// Check if the response indicates success, then redirect
						if (response.includes("successful")) 
						{
							// Start the countdown
							let seconds = 3; // Countdown time in seconds
							var from = document.getElementById("addUserForm");
							if (from.style.display === "none" || from.style.display === "") 
							{
								from.style.display = "none";
							} 
							else 
							{
								from.style.display = "block";
							}
							var element = document.getElementById("countdown");
							if (element.style.display === "none" || element.style.display === "") 
							{
								element.style.display = "block";
							} 
							else 
							{
								element.style.display = "block";
							}
							const countdownInterval = setInterval(function() 
							{
								document.getElementById("countdown").textContent = "Redirecting in " + seconds+ " second...";
								seconds--;
								// Show an alert when the countdown reaches 1
								if (seconds === 3) 
								{
									alert("Redirecting in 3 second...");
								}
								// Redirect the user after the countdown ends
								if (seconds < 0) 
								{
									clearInterval(countdownInterval);
									window.location.href = "verify_otp/sign_up_otp.php"; // Redirect to another page
								}
							}, 1500);
						}
					}
					});
				}
				function isValidEmail(email) 
				{
					return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
				}
				// Function to check if the phone number is in a valid format
				function isValidPhone(phone) 
				{
					return /^\d{10}$/.test(phone);
				}
				// Function to check if the password meets the criteria
				function isValidPassword(password) 
				{
					return password.length >= 6;
				}
				// Add more custom validation as needed
			});
		});
	</script
	<!-- Script End -->

</body>
<!-- Body End -->
</html>
<!-- HTML End -->
