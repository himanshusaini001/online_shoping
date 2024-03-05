
<?php 

include('../include/db_file/config.php');

if(isset($_SESSION['admin']))
{
	header("location: ../index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<link href="../assets/css/front_style.css" rel="stylesheet">
    <title>Login Validation</title>
    <style>
        .error {
            color: red;
        }
    .custom-form {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      border-radius: 10px;
    }

    .custom-form:hover {
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>
<body>

    <div class="container mt-5">
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
				 <div class="custom-form">
				<h3 class="text-center mb-4">Login Page</h3>
				<form id="loginForm" class="profile_form">
				<span><a href="reset_all/sand_link_mail_pass.php" class="login_btn ">Forget Password</a></span>
					<div class="form-group">
						<label for="usernameField">Username:</label> 
						<input type="text" class="form-control" id="usernameField" name="username">
					</div>

					<div class="form-group">
						<label for="passwordField">Password:</label>
						<input type="password" class="form-control" id="passwordField" name="password">
					</div>
					<span>Don't Register <a href="registration.php">Sign Up</a></span>
					<button type="button" 	 class="btn btn-primary login_btn" id="submitButton">Submit</button>
				</form>

        </div>
			</div>
			<div class="col-md-3">
			</div>
		</div>
        
        <div id="errorMessages" class="error mt-3"></div>
<div id="userData" class="error mt-3"></div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#submitButton").click(function () {
                // Clear previous error messages
                $("#errorMessages").html("");

                // Get input values
                var username = $("#usernameField").val();
                var password = $("#passwordField").val();

                // Perform validation
                if (username === "") {
                    $("#errorMessages").html("Please enter a username.");
                    return;
                }

                if (password === "") {
                    $("#errorMessages").html("Please enter a password.");
                    return;
                }

                // If both fields are filled, proceed with AJAX request
                $.ajax({
				type: "POST",
				url: "../functions/function_ajax.php", // Change this to the actual PHP script
				data: {
					action:"login",
					username: username,
					password: password
				},
				dataType: "json", // Expect JSON response
				success: function(response) {
					if (response.status === 'success') {
						// Authentication successful, use the fetched data
						console.log(response);

						/* // Display fetched data in a specific div
						$("#userData").html(
							"<p>First Name: " + response.fname + "</p>" +
							"<p>Last Name: " + response.lname + "</p>" +
							"<p>Email: " + response.email + "</p>" +
							"<p>Address: " + response.address + "</p>" +
							"<p>Phone: " + response.phone + "</p>"
						); */

						// Redirect to another page (e.g., home.html)
						window.location.href = "profile.php"; // Change this to the desired page
					} else {
						// Authentication failed
						$("#errorMessages").html(response.message);
					}
				},
				error: function(error) {
					console.log(error);
					$("#errorMessages").html("Error during AJAX request.");
				}
			});
            });
        });
    </script>

</body>
</html>
