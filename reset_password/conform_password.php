<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Combined Scripts with Bootstrap</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
    /* Custom styling for the shadow */
    .custom-shadow {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <!-- Empty column (col-3) -->
    <div class="col-md-3 d-none d-md-block"></div>
    
    <!-- Form column (col-6) -->
    <div class="col-12 col-md-6 custom-shadow p-4">
	
		<h3>Enter New Password</h3>
      <form id="updatePasswordForm">
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        </div>
        
        <div id="validationMessage" class="text-danger"></div>
        
        <button type="submit" class="btn btn-primary mt-3" id="submitButton" style="display:none;">Submit</button>
      </form>
    </div>

    <!-- Empty column (col-3) -->
    <div class="col-md-3 d-none d-md-block"></div>
  </div>

  <div id="result" class="mt-3"></div>
</div>

<script>
  $(document).ready(function() {
    // Function to validate password and confirm password fields
    function validatePasswordFields() {
      var password = $('#password').val();
      var confirmPassword = $('#confirmPassword').val();
      var validationMessage = $('#validationMessage');
      var submitButton = $('#submitButton');

      if (password.length >= 8 && confirmPassword === password) {
        validationMessage.text('');
        submitButton.prop('disabled', false).show();
      } else {
        validationMessage.text('Passwords do not match or are not at least 8 characters');
        submitButton.prop('disabled', true).hide();
      }
    }

    // Attach event listeners to password and confirm password fields
    $('#password, #confirmPassword').on('input', function() {
      validatePasswordFields();
    });

    // Form submission
    $('#updatePasswordForm').on('submit', function(e) {
      e.preventDefault(); // Prevent form submission
      
      // Your form submission logic here
      var password = $('#password').val();

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: '../functions/function_ajax.php', // Update with your server-side script URL
        data: {
          action: "confirm_pass",
          password: password
        },
        success: function (response) {
          // Update the result div
          $("#result").html(response);
          
          // Redirect if necessary
          if (response.includes("successfully")) {
            window.location.href = "../customer_login.php";
          }
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
  });
</script>

<!-- Include Bootstrap JS (popper.js and bootstrap.js) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
