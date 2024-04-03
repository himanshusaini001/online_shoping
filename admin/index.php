
<?php 

include('../include/db_file/config.php');
	
	if(isset($_SESSION['admin_name']))
	{
			header("location:category/add_category.php");
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
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="custom-form">
                <h3 class="text-center mb-4">Admin Login</h3>
                <form id="loginForm" class="profile_form">
					<div class="form-group">
                        <label for="usernameField">Username:</label>
                        <input type="text" class="form-control" id="admin_name" name="admin_name">
                    </div>

                    <div class="form-group">
                        <label for="passwordField">Password:</label>
                        <input type="password" class="form-control" id="admin_password" name="admin_password">
                    </div>
                    <button type="button" class="btn btn-primary login_btn" id="submitButton">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div id="errorMessages" class="error mt-3"></div>
    <div id="userData" class="error mt-3"></div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $("#submitButton").click(function () {
			try{
				// Clear previous error messages
				$("#errorMessages").html("");

				// Get input values
				var admin_name = $("#admin_name").val();
				var admin_password = $("#admin_password").val();

				// Perform validation
				if (admin_name === "") {
					$("#errorMessages").html("Please enter a username.");
					return;
				}

				if (admin_password === "") {
					$("#errorMessages").html("Please enter a password.");
					return;
				}

				// If both fields are filled, proceed with AJAX request
				$.ajax({
					type: "POST",
					url: "../functions/function_ajax.php",
					data: {
						action: "admin_login",
						admin_name: admin_name,
						admin_password: admin_password
					},
					dataType: 'json', // Specify JSON dataType
					success: function (response) {
						if (response.status === 'success') {
							window.location.href = "../admin/category/show_category.php";
						} else {
							// Authentication failed
							$("#errorMessages").html(response.message);
						}
					},
					error: function (error) {
						console.log(error);
						$("#errorMessages").html("DO NOT MECTH NAME  AND PASSWORD");
					}
				});
			}catch (e) {
				alert("An error occurred at line " + e.line + ": " + e.message);
            }
            
        });
    });
</script>