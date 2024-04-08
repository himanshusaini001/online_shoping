<?php 
	// Including configuration file
	require_once('include/db_file/config.php');

	// Checking if customer is already logged in
	if(isset($_SESSION['customer_login']))
	{
		// Redirecting to index.php if logged in
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
						
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lname" name="lname" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        
                        <label for="phone">Phone:</label>
                        <input type="number" id="phone" name="phone" pattern="[0-9]*" maxlength="10" required>
						</div>
                    <div class="col-md-6">
                        <label for="userAddress">Address:</label>
                        <input type="text" id="address" name="address" required>

                        <label for="userUsername">Username:</label>
                        <input type="text" id="username" name="username" required>

                        <label for="userPassword">Password:</label>
                        <input type="text" id="password" name="password" required>
						

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
			try{
				
				// Get input values
				var fname = $("#fname").val().trim();
				var lname = $("#lname").val().trim();
				var email = $("#email").val().trim();
				var phone = $("#phone").val().trim();
				var address = $("#address").val().trim();
				var username = $("#username").val().trim();
				var password = $("#password").val().trim();

				// Validation for First Name and Last Name (only alphabets)
				var nameRegex = /^[A-Za-z]+$/;
				if (!nameRegex.test(fname)) {
					alert("Please enter valid first and last names (only alphabets).");
					return;
				}
				var lnameRegex = /^[A-Za-z]+$/;
				if (!nameRegex.test(lname)) {
					alert("Please enter valid first and last names (only alphabets).");
					return;
				}

				// Validation for Email (basic format check)
				var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
				if (!emailRegex.test(email)) {
					alert("Please enter a valid email address.");
					return;
				}

				// Validation for Phone (only numbers, exactly 10 digits)
				var phoneRegex = /^[0-9]{10}$/;
				if (!phoneRegex.test(phone)) {
					alert("Please enter a valid 10-digit phone number.");
					return;
				}

				// Validation for Password (at least 6 characters, at least 1 digit)
				var passwordRegex = /^(?=.*\d).{6,}$/;
				if (!passwordRegex.test(password)) {
					alert("Please enter a valid password (at least 6 characters with at least 1 digit).");
					return;
				}

				// Validation for Address (non-empty)
				if (address === "") {
					alert("Please enter your address.");
					return;
				}

				// Validation for Username (non-empty)
				if (username === "") {
					alert("Please enter a username.");
					return;
				}

				// Send the data if all validations pass
				$.ajax({
					type: "POST",
					url: "functions/function_ajax.php",
					data: {
						action: "register",
						fname: fname,
						lname: lname,
						email: email,
						phone: phone,
						address: address,
						username: username,
						password: password
					},
					success: function(response) {
						$("#result");

						// Check if the response indicates success, then redirect
						if (response.includes("successful")) 
						{
							// Start the countdown to
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
			}catch (error) {
				console.error("Error occurred:", error);
			}

        });
    });
</script>
<!-- Script End -->
</body>
<!-- Body End -->
</html>
<!-- HTML End -->
