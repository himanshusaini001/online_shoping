<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
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
      <div class="col-md-6 offset-md-3">
        <div class="custom-form">
          <h3 class="text-center mb-4">Styled Form</h3>
          <form id="loginForm">
					<div class="form-group">
						<label for="usernameField">Username:</label>
						<input type="text" class="form-control" id="usernameField" name="username">
					</div>

					<div class="form-group">
						<label for="passwordField">Password:</label>
						<input type="password" class="form-control" id="passwordField" name="password">
					</div>

					<button type="button" class="btn btn-primary" id="submitButton">Submit</button>
				</form>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
