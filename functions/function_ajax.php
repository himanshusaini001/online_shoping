<?php	
	// Assuming you have a database connection already established
	
		include('../include/db_file/config.php');
		include('../include/db_file/connection_file.php');
		
		// Session Start
	
		
		
		// Session End
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$action = $_POST["action"];
			
			// Registration  function
			 
			if ($action == "register") 
			{
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];
				$email = $_POST["email"];
				$phone = $_POST["phone"];
				$address = $_POST["address"];
				$username = $_POST["username"];
				$password = $_POST["password"];
				
				// Session  Start
				
				
				
				$otp = mt_rand(100000, 999999);
				// Perform data insertion logic into users table
				
				$sql = "INSERT INTO registration (fname, lname, email, phone, address, username, password,otp) VALUES ('$fname', '$lname', '$email', '$phone', '$address', '$username', '$password','$otp')";
				
				if (mysqli_query($conn, $sql)) 
				{
					echo "";
						// Send registration email
						
						$to = $email;  // Adjust this line based on your actual email field name
						$subject = "Registration Successful";
						$message = "Hello $fname $lname,\n\nYour registration is successful.\n\nDetails:\nEmail: $email\nPhone: $phone\nAddress: $address\nUsername: $username";
						$headers = "From: himanshusaini26112002@gmail.com";

						if (mail($to, $subject, $message, $headers)) {
							
							echo "Registration successful! Data added to the database and registration email sent.";
							
							$to = $email; 
							$subject = "Registration OTP";
							$message = "Hello Your OTP is \n\nOTP: $otp";
							$headers = "From: himanshusaini26112002@gmail.com";
							
							if (mail($to, $subject, $message, $headers)) 
							{
								echo "Registration successful! ";
							}
							else {
								echo "Do not match OTP . Please contact support.";
							}
						} else {
							echo "Error sending registration email. Please contact support.";
						}
					
				} 
				else 
				{
					echo "Insert Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
		
		
			// Login  function
			
			

			  if ($action == 'login') {
					
					// Retrieve data from POST request
					$username = $_POST['username'];
					$password = $_POST['password'];

					

					// SQL query to check username and password
					$sql = "SELECT * FROM registration WHERE username = '$username' AND password = '$password'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// Authentication successful
						$row = $result->fetch_assoc();

						// Fetch additional data
						$fname = $row['fname'];
						$lname = $row['lname'];
						$email = $row['email'];
						$address = $row['address'];
						$phone = $row['phone'];
						$username = $row['username'];
						// SESSION Start
						$_SESSION['admin'] = $username;
						$_SESSION['fname'] = $fname;
						$_SESSION['lname'] = $lname;
						$_SESSION['email'] = $email;
						$_SESSION['phone'] = $phone;
						$_SESSION['address'] = $address;

						// SESSION End

						// Prepare the response
						$response = [
							'status' => 'success',
							'message' => 'Authentication successful',
							'fname' => $fname,
							'lname' => $lname,
							'email' => $email,
							'address' => $address,
							'phone' => $phone
						];

						echo json_encode($response);
					} else {
						// Authentication failed
						$response = [
							'status' => 'error',
							'message' => 'Invalid username or password'
						];

						echo json_encode($response);
					}
				}
				
				
				
			// verify_otp  function
			
			 if ($action == "verify_otp") {
				// Check if the OTP is provided
				
				$userInputOTP = $_POST['otp'];

				// Prepare and execute the SQL statement using prepared statements
				$sql = "SELECT otp FROM registration WHERE otp = '$userInputOTP'";
				
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
						
						$otp = $row['otp'];
					
						if($userInputOTP == $otp)
						{
							 echo 'successful';
						}
						
				}
				else{
					  'error';
				}
			}
			
			// verify_otp  function
			
			 if ($action == "random_link") {
				// Check if the OTP is provided
				$email = $_POST["email"];

				// Validate email (you might want to add more robust validation)
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					die("Invalid email address");
				}

				$sql = "SELECT sid FROM registration WHERE email = '$email'";
				
				$result = mysqli_query($conn, $sql);

					if(mysqli_num_rows($result) > 0)
					{
						$row = mysqli_fetch_assoc($result);
						
						$id = $row['sid'];
						$ids = base64_encode($id);
						$sid = bin2hex($ids);
						//echo "successfully!";
						$token = uniqid();
					
					  $resetLink = "http://localhost/online-shoping/admin/reset_all/conform_pass.php?sid=$sid&email=$email&token=".uniqid();
						echo $resetLink; die();
					// Send the link to the user's email (use a proper mail library in production)
					mail($email, "Password Reset", "Click the link to reset your password: $resetLink");
					
					}
				 else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
			
			
			

				// Assuming you have established a database connection ($conn)
				// You should also handle errors and sanitize user input to prevent SQL injection

				if ($action == "confrom_pass") {
					// Check if the OTP is provided
					$password = $_POST['password'];
					$sid = $_POST['sid'];

					// Hash the password
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

					// Update the user information in the database
					$sql = "UPDATE registration SET password='$hashedPassword' WHERE sid='2'";

					if ($conn->query($sql) === TRUE) {
						echo "successfully";
					} else {
						echo "Error updating record: " . $conn->error;
					}
				}

			
		}
		
		mysqli_close($conn);
?>
