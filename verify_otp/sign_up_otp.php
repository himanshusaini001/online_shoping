<!DOCTYPE html>

<html lang="en">
<head>
    <!-- Meta Tags Start -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta Tags End -->
    
    <!-- Bootstrap Links Start -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../assets/css/front_style.css" rel="stylesheet">
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
		  text-align: center;/* Set Align Center  */
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
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form id="addUserForm">
                <h1 class="mb-4">Verify OTP</h1>
				<label for="userPassword">OTP:</label>
				<input type="text" id="otp" name="otp" required>

				<button type="button" id="verify_otp" class="Register_btn">Register</button>
             </form>
			 <p id="countdown" class="countdown countdown-animation">Redirecting in 3 second...</p>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<!-- Result Section -->
<div id="result" class="result"></div>

<script>
		$(document).ready(function() {
			$("#verify_otp").click(function() {
			var otp = $("#otp").val();
			$.ajax({
				type: "POST",
				url: "../functions/function_ajax.php", // Create a new PHP file for handling login logic
				data: {
					action: "verify_otp",
					otp: otp
				},
				success: function(response) {
					$("#result");
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
									window.location.href = "../customer_login.php"; // Redirect to Another page
								}
							}, 1400);
						}else {
						 alert('OTP does not match!');
					}
				}
				
			});
			});
		});
	</script>
	<!-- Script End -->
</body>
<!-- Body End -->
</html>
<!-- HTML End -->
