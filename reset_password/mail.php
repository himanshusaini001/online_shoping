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
            <form id="addUserForm" class="reset_pass_form">
                <h2 class="mb-4">Resert password</h2>
				<label for="email">Email:</label>
				<input type="email" id="email" name="email" required>
				<div id="emailError" class="error"></div>
				
				
				<button type="button" id="addUser" class="Register_btn">submit</button>
            </form>
		<p id="countdown" class="countdown countdown-animation">Redirecting in 3 second...</p>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>


  
<!-- Result Section -->
<div id="result" class="result"></div>
<!-- Script Start -->
	<!-- Script Start -->
<script>
    $(document).ready(function () {
        $("#addUser").click(function () {
            // Custom validation logic
            $(".error").text("");

            // Get input values
            var email = $("#email").val();

            // Validation
            if (!isValidEmail(email)) {
                $("#emailError").text("Invalid email format");
            }

            // If no validation errors, submit the form data using AJAX
            if ($(".error:empty").length === $(".error").length) {
                $.ajax({
                    type: "POST",
                    url: "../functions/function_ajax.php",
                    data: {
                        action: "random_link",
                        email: email
                    },
                    success: function (response) {
                        // Check if the response indicates successful login, then update the result div
                        if (response.includes("successfully")) {
                            // Update the result div
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
									//window.location.href = "reset_password/conform_password.php"; // Redirect to another page
								}
							}, 1500);
                        }
                    }
                });
            }

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }
        });
    });
</script>
<!-- Script End -->

	<!-- Script End -->

</body>
<!-- Body End -->
</html>
<!-- HTML End -->
