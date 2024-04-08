<?php	
		// Assuming you have a database connection already established
		require_once('../include/db_file/config.php');
		require_once('../include/db_file/connection_file.php');


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$action = $_POST["action"];

			//Trim Function Start
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
			return $data;
		}
		//Trim Function End
		
		//Log Message Start 
		function logMessage($message, $type = 'info') {
			
			$logFile = '../admin/logs/log.txt';
			$newTimeZone = 'Asia/Kolkata'; 
			date_default_timezone_set($newTimeZone);
			$currentTimeZone = date_default_timezone_get();
			$Datetamp = date('Y-m-d');
			$Timetamp = date('H:i:s');
			$logMessage = "Today Date:- [$Datetamp] & Time:- [$Timetamp] & Type:- [$type] $message " . PHP_EOL;
			$result = file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
			
			return ($result !== false);
		}

		// Log Message End
		
		// User Login Start
		
		if ($action == "register") {
			try{
				// Sanitize input data
				$fname_c = test_input($_POST["fname"]); // Sanitize first name
				$lname_c = test_input($_POST["lname"]); // Sanitize last name
				$email = test_input($_POST["email"]);   // Sanitize email
				$phone_c = test_input($_POST["phone"]); // Sanitize phone number
				$address_c = test_input($_POST["address"]); // Sanitize address
				$username = test_input($_POST["username"]); // Sanitize username
				$password = md5(test_input($_POST["password"])); // Sanitize password and hash it using MD5
				$otp = mt_rand(100000, 999999); // Generate a random OTP (One-Time Password)

				// Capitalize first letter of first name, last name, phone, and address
				$fname = ucfirst($fname_c);
				$lname = ucfirst($lname_c);
				$phone = ucfirst($phone_c);
				$address = ucfirst($address_c);

				// Check if any of the required fields are empty
				if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($address) || empty($username) || empty($password)) {
					echo "Please fill in all the required fields.";
				}
				else {
					// If all required fields are filled, proceed with inserting data into the database
					$sql = "INSERT INTO user (fname, lname, email, phone, address, username, password, otp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
					$stmt = mysqli_prepare($conn, $sql);

					if ($stmt) {
						// Bind parameters to the SQL statement
						mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $email, $phone, $address, $username, $password, $otp);

						// Execute the prepared statement
						if (mysqli_stmt_execute($stmt)) {
							// If the insertion is successful, send registration email
							$to = $email;
							$subject = "Registration Successful";
							$message = "Hello $fname $lname,\n\nYour registration is successful.\n\nDetails:\nEmail: $email\nPhone: $phone\nAddress: $address\nUsername: $username";
							$headers = "From: himanshusaini26112002@gmail.com";

							// Send registration email
							if (mail($to, $subject, $message, $headers)) {
								echo "Registration successful! Data added to the database and registration email sent.";

								// Send OTP
								$to = $email;
								$subject = "Registration OTP";
								$message = "Hello Your OTP is \n\nOTP: $otp";
								$headers = "From: himanshusaini26112002@gmail.com";

								// Send OTP email
								if (mail($to, $subject, $message, $headers)) {
									echo "Registration successful! ";
								} else {
									echo "Error sending OTP email. Please contact support.";
								}
							} else {
								echo "Error sending registration email. Please contact support.";
							}
						} else {
							echo "Insert Error: " . mysqli_stmt_error($stmt);
						}

						// Close the prepared statement
						mysqli_stmt_close($stmt);
					} else {
						echo "Prepare statement error: " . mysqli_error($conn);
					}
				}
		}

		// User Login End

		// Add Size Start

		if ($action == "add_size") {
			try{
				$size = test_input($_POST['size']); // Sanitize $size
				$status = test_input($_POST['status']);// Sanitize $Status
				
				// Insert the Data clothing Size use by Prepare Method
				$stmt = $conn->prepare("INSERT INTO clothing_sizes (size, status) VALUES (?, ?)");
				$stmt->bind_param("ss", $size, $status); // Execute Query 
				$stmt->execute();
				
				 if ($stmt->affected_rows > 0) {
					// If the statement affected rows are greater than 0, indicating a successful insertion
					echo json_encode(['status' => true]); // Return success status as JSON
					$_SESSION['msg'] = "Size added successfully"; // Set session message indicating success
					logMessage("Successfully added size: $size"); // Log a message indicating successful addition of size
				} else {
					// If affected rows are not greater than 0, indicating a failed insertion
					echo json_encode(['status' => false, 'error' => 'Failed to add size']); // Return failure status with an error message as JSON
					$_SESSION['msg'] = "Failed to add size"; // Set session message indicating failure
					logMessage("Failed to add size: $size", 'error'); // Log an error message indicating failure to add size
				}

				$stmt->close(); // Close the statement

			}
			catch (Exception $e) {
				// If an exception is caught during execution
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Return failure status with a generic error message as JSON
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log the exception message with 'error' level
				logMessage("Line: " . $e->getLine(), 'error'); // Log the line number where the exception occurred with 'error' level
			}
		}
		
		// Add Size End
		
		//Add Color Start

		if ($action == "add_color") {
			try {
				$color = ucfirst(test_input($_POST['color'])); // Sanitize Color
				$status = test_input($_POST['status']);// Sanitize Status
				// Insert the Data Color use by Prepare Method
				$sql = "INSERT INTO colors (color_name,status) VALUES (?, ?)";
				$stmt = $conn->prepare($sql); // Execute Query
				$stmt->bind_param("ss", $color, $status);
				$stmt->execute(); // Close The Statement
				
				if ($stmt->affected_rows > 0) {
					// If the statement affected rows are greater than 0, indicating a successful insertion
					echo json_encode(['status' => true]); // Return success status as JSON
					$_SESSION['msg'] = "Color added successfully"; // Set session message indicating success
					logMessage("Successfully added color: " . $color); // Log a message indicating successful addition of color
				} else {
					// If affected rows are not greater than 0, indicating a failed insertion
					echo json_encode(['status' => false]); // Return failure status as JSON
					$_SESSION['msg'] = "Failed to add color"; // Set session message indicating failure
					logMessage("Failed to add color: " . $color); // Log an error message indicating failure to add color
				}

				$stmt->close(); // Close the statement

				} catch (Exception $e) {
					// Catch any exception that occurs during execution
					echo json_encode(['status' => false, 'message' => 'An error occurred']); // Return failure status with a generic error message as JSON
					logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log the exception message with 'error' level
					logMessage("Line: " . $e->getLine(), 'error'); // Log the line number where the exception occurred with 'error' level
				}
		}

		
		//Add Color End

		//Reset Password Start

		if ($action == "confirm_pass") {
			try {
				// Sanitize input and hash the password
				$password = md5(test_input($_POST['password']));
				$sid = 3;
				// Prepare SQL statement to update the password
				 // Assuming 1 is the user's sid
				$stmt = $conn->prepare("UPDATE user SET password = ? WHERE sid = ?");
				$stmt->bind_param("si", $password, $sid); // Execute Query
					
				// Execute the statement
				if ($stmt->execute()) {
					// If the statement execution is successful
					echo "Password successfully updated"; // Output success message
					logMessage("Password successfully updated"); // Log success message
				} else {
					// If there's an error in executing the statement
					echo "Error updating password: " . $conn->error; // Output error message
					logMessage("Failed to update password: " . $conn->error, 'error'); // Log error message
				}

				// Close the statement
				$stmt->close(); // Close the prepared statement

			} catch (Exception $e) {
				// Catch any exception that occurs during execution
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Return failure status with a generic error message as JSON
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log the exception message with 'error' level
				logMessage("Line: " . $e->getLine(), 'error'); // Log the line number where the exception occurred with 'error' level
			}
		}
		//Reset Password Start
		
		// Update Size Start
		
		if ($action == "update_size") { // Check if action is to update size
			try {
				$size = test_input($_POST['size']); // Sanitize Size
				$sid = test_input($_POST['sid']); // Sanitize Sid
				$status = test_input($_POST['status']); // Sanitize Status
				
				// Update Query
				$sql = "UPDATE clothing_sizes SET size=?, status=? WHERE sid=?";
				$stmt = $conn->prepare($sql); // Prepare statement
				
				// Bind parameters and execute query
				$stmt->bind_param("ssi", $size, $status, $sid);
				$stmt->execute();
				
				// Check if the query was successful
				if ($stmt->affected_rows > 0) {
					echo json_encode(['status' => true]); // Return success status as JSON
					$_SESSION['msg'] = "Update Size successfully"; // Set session message indicating success
					logMessage("Successfully Updated Size: $size, Size ID: $sid"); // Log a message indicating successful update of size
				} else {
					echo json_encode(['status' => false]); // Return failure status as JSON
					$_SESSION['msg'] = "Failed to Update Size"; // Set session message indicating failure
					logMessage("Failed to Update Size: $size, Size ID: $sid", 'error'); // Log an error message indicating failure to update size
				}
				// Close statement
				$stmt->close(); // Close the prepared statement
			} catch (Exception $e) {
				// Handle exceptions
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Return failure status with a generic error message as JSON
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log the exception message with 'error' level
				logMessage("Line: " . $e->getLine(), 'error'); // Log the line number where the exception occurred with 'error' level
			}
		}
		
		// Update Size End
		
		// Update Color Start

		if ($action == "update_color") { // Check if action is to update color
			try {
				$color_name = ucfirst(test_input($_POST['color_name'])); // Sanitize Color Name
				$color_id = test_input($_POST['color_id']); // Sanitize Color id
				$status = test_input($_POST['status']); // Sanitize status

				// Using prepared statement to update color
				$stmt = $conn->prepare("UPDATE colors SET color_name=?, status=? WHERE color_id=?");
				$stmt->bind_param("ssi", $color_name, $status, $color_id); // Bind parameters
				$stmt->execute(); // Execute Query
				// Check if the query was successful
				if ($stmt->affected_rows > 0) {
					echo json_encode(['status' => true]); // Return success status as JSON
					$_SESSION['msg'] = "Color updated successfully"; // Set session message indicating success
					logMessage("Successfully updated color. Color ID: " . $color_id); // Log a message indicating successful update of color
				} else {
					echo json_encode(['status' => false]); // Return failure status as JSON
					$_SESSION['msg'] = "Failed to update color"; // Set session message indicating failure
					logMessage("Failed to update color. Color ID: " . $color_id); // Log an error message indicating failure to update color
				}
				$stmt->close(); // Close the prepared statement
			} catch (Exception $e) {
				// Handle exceptions
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Return failure status with a generic error message as JSON
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log the exception message with 'error' level
				logMessage("Line: " . $e->getLine(), 'error'); // Log the line number where the exception occurred with 'error' level
			}
		}

		// Update Color Start

		// Delete size Start

		if ($action == "delete_size") { // Check if the action is to delete a size
			try {
				$sid = test_input($_POST['sid']); // Sanitize sid

				// Prepare SQL statement to delete size by sid
				$stmt = $conn->prepare("DELETE FROM clothing_sizes WHERE sid = ?");
				$stmt->bind_param("i", $sid); // Bind sid parameter
				// Execute the query
				if ($stmt->execute()) {
					// Check if any records were affected
					if ($stmt->affected_rows > 0) {
						echo "Record deleted successfully"; // Output success message
						$_SESSION['msg'] = "Size deleted successfully"; // Set session message for success
						logMessage("Successfully deleted size with ID ".$sid); // Log successful deletion
					} else {
						echo "No records deleted"; // Output message if no records were deleted
						$_SESSION['msg'] = "No size deleted"; // Set session message if no records were deleted
						logMessage("No records deleted for size with ID ".$sid); // Log no deletion
					}
				} else {
					echo "Error deleting record: " . $stmt->error; // Output error message if deletion fails
					$_SESSION['msg'] = "Error deleting size"; // Set session message for error
					logMessage("Failed to delete size with ID ".$sid); // Log failure to delete
				}

				$stmt->close(); // Close the prepared statement
			} catch (Exception $e) {
				// Catch any exceptions that occur
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Output generic error message
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log the exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log the line number where the exception occurred
			}
		}
		
		// Delete size End

		// Delete color Start

		if ($action == "delete_color") { // Check if the action is to delete a color
			try {
				$color_id = test_input($_POST['color_id']); // Sanitize Color Id

				// Prepare SQL statement to delete color by color_id
				$sql = "DELETE FROM colors WHERE color_id = ?";
				$stmt = $conn->prepare($sql); // Prepare the statement
				$stmt->bind_param("i", $color_id); // Bind color_id parameter

				// Execute the query
				if ($stmt->execute()) {
					echo "Record deleted successfully"; // Output success message
					$_SESSION['msg'] = "Delete Color successfully"; // Set session message for success
					logMessage("Successfully deleted Color with ID = ".$color_id); // Log successful deletion
				} else {
					echo "Error deleting record: " . $stmt->error; // Output error message if deletion fails
					$_SESSION['msg'] = "Failed to delete Color"; // Set session message for error
					logMessage("Failed to delete Color with ID = ".$color_id); // Log failure to delete
				}
				$stmt->close(); // Close the prepared statement
			} catch (Exception $e) {
				// Catch any exceptions that occur
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Output generic error message
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log the exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log the line number where the exception occurred
			}
		}

		// Delete color End

		// User Login Start
		
		if ($action == 'login') { // Check if action is 'login'
			try {
				$username = test_input($_POST['username']); // Sanitize Username
				$password = test_input(md5($_POST["password"])); // Sanitize and hash Password

				// SQL query to select user based on username and password
				$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
				$result = $conn->query($sql); // Execute Query

				if ($result->num_rows > 0) { // If user found
					$row = $result->fetch_assoc(); // Fetch user data

					if ($row['status'] == 0) { // If user status is inactive
						$response = [
							'status' => 'error',
							'message' => 'Your ID is not active'
						];
						echo json_encode($response); // Send error response
						exit; // Exit script
					}

					// Extract user data from row
					$customer_id = test_input($row['sid']);
					$fname_c = test_input($row['fname']);
					$fname = ucfirst($fname_c);
					$lname_c = test_input($row['lname']);
					$lname = ucfirst($lname_c);
					$email = test_input($row['email']);
					$address_c = test_input($row['address']);
					$address = ucfirst($address_c);
					$phone = test_input($row['phone']);
					$username = test_input($row['username']);

					// Start session and store user data
					$_SESSION['customer_id'] = $customer_id;
					$_SESSION['customer_login'] = $username;
					$_SESSION['fname'] = $fname;
					$_SESSION['lname'] = $lname;
					$_SESSION['email'] = $email;
					$_SESSION['phone'] = $phone;
					$_SESSION['address'] = $address;

					// Prepare success response
					$response = [
						'status' => 'success',
						'message' => 'Authentication successful',
						'fname' => $fname,
						'lname' => $lname,
						'email' => $email,
						'address' => $address,
						'phone' => $phone
					];
					echo json_encode($response); // Send success response
				} else { // If user not found or authentication failed
					$response = [
						'status' => 'error',
						'message' => 'Invalid username or password'
					];
					echo json_encode($response); // Send error response
				}
			} catch (Exception $e) { // Catch any exceptions
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Send generic error response
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number of exception
			}
		}

		// User Login End

		// OTP verify Start 

		if ($action == "verify_otp") { // Check if action is to verify OTP
			try {
				$userInputOTP = test_input($_POST['otp']); // Sanitize User Input OTP

				// Use prepared statements to prevent SQL injection
				$stmt = $conn->prepare("SELECT otp FROM user WHERE otp = ?");
				$stmt->bind_param("s", $userInputOTP); // Bind user input OTP parameter
				$stmt->execute(); // Execute Query
				$stmt->store_result();

				if ($stmt->num_rows > 0) { // If matching OTP found
					$stmt->bind_result($otp); // Bind result
					$stmt->fetch(); // Fetch result

					if ($userInputOTP == $otp) { // If user input OTP matches fetched OTP
						echo 'successful'; // Output success message
						logMessage("Successfully verified OTP: $userInputOTP"); // Log successful OTP verification
					} else { // If user input OTP does not match fetched OTP
						echo 'error'; // Output error message
						logMessage("Failed verification of OTP: $userInputOTP"); // Log failed OTP verification
					}
				} else { // If no matching OTP found
					echo 'error'; // Output error message
					logMessage("No matching OTP found: $userInputOTP"); // Log no matching OTP found
				}

				$stmt->close(); // Close The Statement
			} catch (Exception $e) { // Catch any exceptions
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Send generic error response
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number of exception
			}
		}
		
		// OTP verify End 

		// OTP Random Link Start
		if ($action == "random_link") { // Check if action is to generate a random link
			try {
				$email = test_input($_POST["email"]); // Sanitize Email

				// Validate email format
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					die("Invalid email address"); // Stop execution if email is invalid
				}

				// Prepare SQL statement to prevent SQL injection
				$stmt = $conn->prepare("SELECT sid FROM user WHERE email = ?");
				$stmt->bind_param("s", $email); // Bind email parameter
				$stmt->execute(); // Execute Query
				$result = $stmt->get_result();

				if ($result->num_rows > 0) { // If user with provided email exists
					$row = $result->fetch_assoc(); // Fetch user data

					$id = $row['sid']; // Get user's sid
					$ids = base64_encode($id); // Encode sid
					$sid = bin2hex($ids); // Convert encoded sid to hex
					
					// Generate a secure token
					$token = bin2hex(random_bytes(16));

					// Construct reset link
					$resetLink = "http://localhost/online-shoping/reset_password/conform_password.php?sid=$sid&email=$email&token=$token";

					// Send the link to the user's email (use a proper mail library in production)
					// mail($email, "Password Reset", "Click the link to reset your password: $resetLink");

					// Log success
					logMessage("Successfully sent OTP Link to: ".$email);
					
					// Output reset link for testing
					echo $resetLink;
				} else {
					echo "Error: No user found with the provided email."; // Output error message if no user found
					logMessage("No user found with the provided email: ".$email); // Log no user found error
				}
			} catch (Exception $e) { // Catch any exceptions
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Send generic error response
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number of exception
			}
		}
		
		// OTP Random Link End
		
		// Admin Login Start
		
		if ($action == "admin_login") {
			try {
				// Get form data
				$admin_name = test_input($_POST['admin_name']); // Sanitize Admin name 
				$admin_password = test_input($_POST['admin_password']); // Sanitize Admin Password

				// Prepare and bind parameters
				$stmt = $conn->prepare("SELECT * FROM admin WHERE name = ? AND password = ?");
				$stmt->bind_param("ss", $admin_name, $admin_password); // Bind parameters securely
				$stmt->execute();
				$result = $stmt->get_result();

				// Check if the admin exists
				if ($result->num_rows === 1) {
					// Admin exists, set session and respond with success
					$_SESSION['admin_name'] = $admin_name;
					header('Content-Type: application/json');
					echo json_encode(["status" => "success"]);
					logMessage("Successfully Admin Login = " . $admin_name);
				} else {
					// Admin does not exist, respond with error
					header('Content-Type: application/json');
					echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
					logMessage("Failed to fetch Admin Login Data for: " . $admin_name);
				}
			} catch (Exception $e) {
				// Exception occurred, respond with error
				header('Content-Type: application/json');
				echo json_encode(['status' => 'error', 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		// Admin Login End
	
		// Add category Start

		if ($action == "category") {
			try {
				if(isset($_POST['cname']) && isset($_FILES['cimg']['name'])) {
					// Sanitize input data
					$cname_c = test_input($_POST['cname']); // Sanitize cname
					$cname = ucfirst($cname_c);
					$cimg = test_input($_FILES['cimg']['name']); // Sanitize Cimg

					$uploadDir = '../admin/assets/upload_img/';
					$uploadedFile = $uploadDir . basename($_FILES['cimg']['name']);

					// Move uploaded file to destination directory
					if(move_uploaded_file($_FILES['cimg']['tmp_name'], $uploadedFile)) {
						// Sanitize status
						$status = test_input($_POST['status']);

						// Using prepared statements for security
						$stmt = $conn->prepare("INSERT INTO category (cname, cimg, status) VALUES (?, ?, ?)");
						$stmt->bind_param("sss", $cname, $cimg, $status);

						// Execute the prepared statement
						if ($stmt->execute()) {
							echo json_encode(['status' => true]);
							$_SESSION['msg'] = "Add Categories successfully";
							logMessage("Successfully added Category = ".$cname);
						} else {
							echo json_encode(['status' => false]);
							$_SESSION['msg_error'] = "Failed to add Categories ";
							logMessage("Failed to add Category = ".$cname, 'error');
						}
					} else {
						throw new Exception("Failed to move uploaded file.");
					}
				} else {
					throw new Exception("cname and cimg should not be empty.");
				}
			} catch (Exception $e) {
				// Catch any exceptions and log them
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}
		
		// Add category End

		// Show Data Category Start 

		if ($action == "fetch_data") {
			try {
				// Select all data from the category table
				$sql = "SELECT * FROM category";
				$result = mysqli_query($conn, $sql); // Execute the query

				// Check if the SQL query executed successfully
				if (!$result) {
					throw new Exception("SQL query failed: " . mysqli_error($conn)); // Throw an exception with the error message
				}

				// Initialize output variable
				$output = "";

				// Check if there are any rows returned
				if (mysqli_num_rows($result) > 0) {
					// If there are rows, start building the HTML table
					$output = '<table border="1" width="100%" cellspacing="0" cellpadding="10" class="category_table_style">';
					$output .= '<tr>
									<th>cid</th>
									<th>cname</th>
									<th>cimg</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>';

					// Loop through each row and populate the table
					while ($row = mysqli_fetch_assoc($result)) {
						$output .= "<tr>
										<td>{$row['cid']}</td>
										<td>{$row['cname']}</td>
										<td>{$row['cimg']}</td>
										<td><a class='btn btn-success' href='update_category.php?cid={$row['cid']}'>Update</a></td>
										<td><a class='btn btn-danger' href='delete_category.php?cid={$row['cid']}'>Delete</a></td>
									</tr>";
					}

					// Close the HTML table
					$output .= "</table>";

					// Output the HTML table
					echo $output;
				} else {
					// If no records found, display this message
					echo "No records found";
				}
			} catch (Exception $e) {
				// Catch any exceptions and handle them
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Output error message in JSON format
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number where exception occurred
			}
		}

		// Show Data Category End 
		
		// Show data Size Start
		
		if ($action == "fetch_size") {
			try {
				// SQL query to fetch all clothing sizes
				$sql = "SELECT * FROM clothing_sizes";
				$result = mysqli_query($conn, $sql); // Execute the query

				// Check if the query execution was successful
				if (!$result) {
					throw new Exception("SQL query failed: " . mysqli_error($conn)); // Throw an exception with the error message
				}

				// Initialize output variable
				$output = "";

				// Check if there are rows returned from the query
				if (mysqli_num_rows($result) > 0) {
					// If there are rows, start building the HTML table
					$output = '<table border="1" width="100%" cellspacing="0" cellpadding="10" class="category_table_style">';
					$output .= '<tr>
									<th>sid</th>
									<th>size</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>';

					// Loop through each row returned from the query
					while ($row = mysqli_fetch_assoc($result)) {
						// Append the row data to the HTML table
						$output .= "<tr>
										<td>{$row['sid']}</td>
										<td>{$row['size']}</td>
										<td><a class='btn btn-success' href='update_size.php?sid={$row['sid']}'>Update</a></td>
										<td><a class='btn btn-danger' href='delete_size.php?sid={$row['sid']}'>Delete</a></td>
									</tr>";
					}

					// Close the HTML table
					$output .= "</table>";

					// Output the HTML table
					echo $output;
				} else {
					// If no rows found, output a message
					echo "No records found";
				}
			} catch (Exception $e) {
				// Catch any exceptions and handle them
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Output error message in JSON format
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number where exception occurred
			}
		}

		
		// Show data Size End

		// Show data Color Start
		if ($action == "fetch_color") {
			try {
				// SQL query to fetch all colors
				$sql = "SELECT * FROM colors";
				$result = mysqli_query($conn, $sql); // Execute the query

				// Check if the query execution was successful
				if (!$result) {
					throw new Exception("SQL query failed: " . mysqli_error($conn)); // Throw an exception with the error message
				}

				// Initialize output variable
				$output = "";

				// Check if there are rows returned from the query
				if (mysqli_num_rows($result) > 0) {
					// If there are rows, start building the HTML table
					$output = '<table border="1" width="100%" cellspacing="0" cellpadding="10" class="category_table_style">';
					$output .= '<tr>
									<th>color_id</th>
									<th>Color Name</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>';

					// Loop through each row returned from the query
					while ($row = mysqli_fetch_assoc($result)) {
						// Append the row data to the HTML table
						$output .= "<tr>
										<td>{$row['color_id']}</td>
										<td>{$row['color_name']}</td>
										<td><a class='btn btn-success' href='update_color.php?color_id={$row['color_id']}'>Update</a></td>
										<td><a class='btn btn-danger' href='delete_color.php?color_id={$row['color_id']}'>Delete</a></td>
									</tr>";
					}

					// Close the HTML table
					$output .= "</table>";

					// Output the HTML table
					echo $output;
				} else {
					// If no rows found, output a message
					echo "No records found";
				}
			} catch (Exception $e) {
				// Catch any exceptions and handle them
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Output error message in JSON format
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number where exception occurred
			}
		}

		// Show data Color End
		
		// Delete Category Start

		if ($action == "delete_category") {
			try {
				$cid = test_input($_POST['cid']); // Sanitize category ID

				// Use prepared statement for security
				$stmt = $conn->prepare("DELETE FROM category WHERE cid = ?"); // Prepare SQL statement
				$stmt->bind_param("i", $cid); // Bind category ID parameter

				// Execute the prepared statement
				if ($stmt->execute()) {
					echo "Record deleted successfully"; // Output success message
					$_SESSION['msg'] = "Delete Categories successfully"; // Set success message in session
					logMessage("Successfully deleted Category = " . $cid); // Log success message
				} else {
					echo "Error deleting record: " . $stmt->error; // Output error message
					$_SESSION['msg_error'] = "Failed to delete Category"; // Set error message in session
					logMessage("Failed to delete Category = " . $cid, 'error'); // Log error message
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Output error message in JSON format
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number where exception occurred
			}
		}


		
		// Delete Category End
		
		// Update Category Start

		if ($action == "update_category") {
			try {
				// Get data from AJAX request and sanitize
				$cname_c = test_input($_POST['cname']); // Sanitize category name
				$cname = ucfirst($cname_c); // Capitalize category name
				$status = test_input($_POST['status']); // Sanitize status
				$cid = test_input($_POST['cid']); // Sanitize category ID

				// Check if a file is uploaded
				if (!empty($_FILES['cimg']['name'])) {
					$cimg = test_input($_FILES['cimg']['name']); // Sanitize uploaded file name
					$uploadDir = '../admin/assets/upload_img/'; // Set upload directory
					$uploadedFile = $uploadDir . basename($_FILES['cimg']['name']); // Set uploaded file path
					move_uploaded_file($_FILES['cimg']['tmp_name'], $uploadedFile); // Move uploaded file to destination
				} else {
					// If no file is uploaded, retain the existing image name
					$folder_img = "SELECT cimg FROM category WHERE cid=?"; // SQL query to retrieve existing image name
					$stmt = $conn->prepare($folder_img); // Prepare SQL statement
					$stmt->bind_param("i", $cid); // Bind parameter
					$stmt->execute(); // Execute SQL query
					$res = $stmt->get_result(); // Get query result
					$row = $res->fetch_assoc(); // Fetch result as associative array
					$cimg = test_input($row['cimg']); // Sanitize and store existing image name
				}

				// Use prepared statement to prevent SQL injection
				$sql = "UPDATE category SET cname=?, cimg=?, status=? WHERE cid=?"; // SQL query to update category
				$stmt = $conn->prepare($sql); // Prepare SQL statement
				$stmt->bind_param("sssi", $cname, $cimg, $status, $cid); // Bind parameters

				// Execute SQL query
				if ($stmt->execute()) {
					echo json_encode(['status' => true]); // Return success status
					$_SESSION['msg'] = "Update Categories successfully"; // Set success message
					logMessage("Successfully updated Category: " . $cname . " (Category ID: " . $cid . ")"); // Log success message
				} else {
					echo json_encode(['status' => false]); // Return failure status
					$_SESSION['msg_error'] = "Failed to update Categories"; // Set error message
					logMessage("Failed to update Category: " . $cname . " (Category ID: " . $cid . ")", 'error'); // Log error message
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Return error status and message
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number where exception occurred
			}
		}


		
		// Update Category End

		// Add product  Start

		if ($action == "add_product") {
			try {
				// Get data from AJAX request and sanitize
				$category_c = test_input($_POST['category']); // Sanitize category
				$category = ucfirst($category_c); // Capitalize category
				$product_color = test_input($_POST['product_color']); // Sanitize product color
				$product_size = test_input($_POST['product_size']); // Sanitize product size
				$product_stock = test_input($_POST['product_stock']); // Sanitize product stock
				$price = test_input($_POST['price']); // Sanitize price
				$product_name_c = test_input($_POST['product_name']); // Sanitize product name
				$product_name = ucfirst($product_name_c); // Capitalize product name
				$description_c = test_input($_POST['description']); // Sanitize description
				$description = ucfirst($description_c); // Capitalize description
				$status = test_input($_POST['status']); // Sanitize status

				// Array to store uploaded file names
				$product_imgs = array();

				// Process multiple file uploads
				if (!empty($_FILES['product_img']['name'][0])) {
					$uploadDir = '../admin/assets/upload_img/';
					foreach ($_FILES['product_img']['name'] as $key => $name) {
						$tmp_name = $_FILES['product_img']['tmp_name'][$key];
						$newFileName = $uploadDir . basename($name);
						if (move_uploaded_file($tmp_name, $newFileName)) {
							$product_imgs[] = $newFileName; // Store uploaded file names
						} else {
							echo "Error uploading file: " . $name; // Display error message if file upload fails
						}
					}
				}

				// Construct SQL query
				$sql = "INSERT INTO product (category,product_color,product_size,stock,price,product_name,description,product_img,status) VALUES ('$category','$product_color','$product_size','$product_stock','$price','$product_name','$description','" . implode(',', $product_imgs) . "','$status')";

				// Execute SQL query
				if ($conn->query($sql) === TRUE) {
					echo json_encode(["status"=>true]); // Return success status
					$_SESSION['msg'] = "Add Data Successfully"; // Set success message
					logMessage("Successfully added product: ".$product_name.", Category ID: ".$category);
				} else {
					echo json_encode(["status"=>false]); // Return failure status
					$_SESSION['msg_error'] = "Failed to Add Data"; // Set error message
					logMessage("Failed to add product: ".$product_name.", Category ID: ".$category, 'error');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']); // Return error status and message
				logMessage("Exception caught: " . $e->getMessage(), 'error'); // Log exception message
				logMessage("Line: " . $e->getLine(), 'error'); // Log line number where exception occurred
			}
		}

		// Update Product Start

		if ($action == "update_product") {
			try {
				// Get data from AJAX request
				$product_id = test_input($_POST['product_id']); // Sanitize Product Id 
				$category = test_input($_POST['category']); // Sanitize Category
				$product_color = test_input($_POST['product_color']); // Sanitize product Color
				$product_size = test_input($_POST['product_size']); // Sanitize Product Size
				$price = test_input($_POST['price']);// Sanitize Price
				$product_name = test_input($_POST['product_name']); // Sanitize Product name
				$description = test_input($_POST['description']); // Sanitize description
				$status = test_input($_POST['status']); // Sanitize Status 

				// Array to store uploaded file names
				$product_imgs = array();

				if (!empty($_FILES['product_img']['name'][0])) { // Check if any files were uploaded
				$uploadDir = '../admin/assets/upload_img/'; // Set the upload directory
				
				foreach ($_FILES['product_img']['name'] as $key => $name) { // Loop through each uploaded file
					$tmp_name = $_FILES['product_img']['tmp_name'][$key]; // Get the temporary file name
					$filename = $uploadDir . basename($name); // Set the destination file path
					
					// Validate file type and move file
					$fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Get the file extension
					if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']) && $_FILES['product_img']['size'][$key] < 5000000) { // Check if file type and size are valid
						if (move_uploaded_file($tmp_name, $filename)) { // Move the file to the upload directory
							$product_imgs[] = $filename; // Store the file name
						} else {
							throw new Exception("Error uploading file: " . $name); // Throw exception if file upload fails
						}
					} else {
						throw new Exception("Invalid file type or file size exceeds the limit for file: " . $name); // Throw exception for invalid file type or size
					}
				}
				$product_img = implode(',', $product_imgs); // Convert array of file names to comma-separated string
				}
				 else {
					// If no file is uploaded, retain the existing image name
					$stmt_folder = $conn->prepare("SELECT product_img FROM product WHERE product_id=?");
					$stmt_folder->bind_param("i", $product_id);
					$stmt_folder->execute();
					$stmt_folder->bind_result($existing_img);
					$stmt_folder->fetch();
					$product_img = $existing_img;
					$stmt_folder->close();
				}

				// Use prepared statement to prevent SQL injection
				$stmt_update = $conn->prepare("UPDATE product SET category=?, product_color=?, product_size=?, price=?, product_name=?, description=?, product_img=?, status=? WHERE product_id=?");
				$stmt_update->bind_param("ssssssssi", $category, $product_color, $product_size, $price, $product_name, $description, $product_img, $status, $product_id);

				if ($stmt_update->execute()) {
					echo json_encode(["status" => true]);
					$_SESSION['msg'] = "Update Data Successfully";
					logMessage("Successfully updated Product: " . $product_name . " (Category ID: " . $category . ")");
				} else {
					echo json_encode(["status" => false]);
					$_SESSION['msg_error'] = "Failed to Update Product";
					logMessage("Failed to update Product: " . $product_name . " (Category ID: " . $category . ")", 'error');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}


		// Update Product End

		// Delete product Start

		if ($action == "delete_product") {
			try {
				// Get the product_id from the POST request and sanitize it
				$product_id = test_input($_POST['product_id']);

				// Use prepared statement to prevent SQL injection
				$stmt = $conn->prepare("DELETE FROM product WHERE product_id=?");
				$stmt->bind_param("i", $product_id);

				// Execute the prepared statement
				if ($stmt->execute()) {
					// If deletion is successful, echo success message and set session message
					echo "Record deleted successfully";
					$_SESSION['msg'] = "Delete Data Successfully";
					logMessage("Successfully deleted Product ID: " . $product_id);
				} else {
					// If deletion fails, echo error message and set session error message
					echo "Error deleting record: " . $stmt->error;
					$_SESSION['msg_error'] = "Failed to delete Product";
					logMessage("Failed to delete Product ID: " . $product_id, 'error');
				}
			} catch (Exception $e) {
				// Catch any exceptions and log them
				echo json_encode(['status' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}


		// Delete product End
		
		// Customer contact Start

		if ($action == "contact") {
			try {
				// Get data from POST request
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$message = $_POST['message'];

				// Prepare and bind the SQL statement with prepared statement
				$stmt = $conn->prepare("INSERT INTO customer_contact (fname, lname, email, phone, message) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("sssss", $fname, $lname, $email, $phone, $message);

				if ($stmt->execute()) {
					// If insertion is successful, send email and return 'success'
					$to = "recipient@example.com"; // Change this to your email address
					$subject = "New Contact Form Submission";
					$body = "First Name: $fname\nLast Name: $lname\nEmail: $email\nPhone: $phone\nMessage: $message";
					$headers = "From: $email";

					// Check if email is valid before sending
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						if (mail($to, $subject, $body, $headers)) {
							echo json_encode(['status' => true]);
							logMessage("Successfully added Contact: $fname $lname (Email: $email)");
						} else {
							echo json_encode(['status' => false, 'message' => 'Error sending email']);
							logMessage("Failed to send email for Contact: $fname $lname (Email: $email)", 'error');
						}
					} else {
						echo json_encode(['status' => false, 'message' => 'Invalid email address']);
						logMessage("Invalid email address for Contact: $fname $lname (Email: $email)", 'error');
					}
				} else {
					// If insertion fails, return an error message
					echo json_encode(['status' => false, 'message' => 'Error inserting into database']);
					$_SESSION['msg_error'] = "Error";
					logMessage("Failed to insert Contact into database: $fname $lname (Email: $email)", 'error');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}


		
		// Customer contact End
		
		// Update User Start

		if ($action == "update_user") {
			try {
				// Get data from AJAX request
				$email = test_input($_POST['email']);
				$status = test_input($_POST['status']);
				$sid = test_input($_POST['sid']);

				// Use prepared statement to prevent SQL injection
				$sql = "UPDATE user SET status=? WHERE sid=?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ii", $status, $sid);

				if ($stmt->execute()) {
					// Check if the status is changed to active
					if ($status == 1) {
						// Set up email parameters
						$to = $email;
						$subject = "Your account is now active";
						$message = "Dear user,\n\nYour account is now active. Thank you for joining us!";
						$headers = "From: himanshusaini26112002@gmail.com";

						// Send the email
						if (mail($to, $subject, $message, $headers)) {
							echo json_encode(['status' => 1]);
							$_SESSION['msg'] = "User status updated successfully";
						} else {
							echo json_encode(['status' => false, 'message' => 'Failed to send email']);
							$_SESSION['msg_error'] = "Error sending email";
						}
					} else {
						echo json_encode(['status' => 0]);
						$_SESSION['msg'] = "User status updated successfully";
					}
				} else {
					echo json_encode(['status' => false, 'message' => $stmt->error]);
					$_SESSION['msg_error'] = "Error updating user status";
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Update User End

		// Add  billing Address Start

		if ($action == "billing_address") {
			try {
				// Get data from AJAX request and sanitize
				$first_name = ucfirst(test_input($_POST['first_name']));
				$last_name = ucfirst(test_input($_POST['last_name']));
				$email = ucfirst(test_input($_POST['email']));
				$phone = ucfirst(test_input($_POST['phone']));
				$address_line_1 = ucfirst(test_input($_POST['address_line_1']));
				$address_line_2 = ucfirst(test_input($_POST['address_line_2']));
				$country = ucfirst(test_input($_POST['country']));
				$city = ucfirst(test_input($_POST['city']));
				$state = ucfirst(test_input($_POST['state']));
				$pin_code = ucfirst(test_input($_POST['pin_code']));

				// Validate email format
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo json_encode(['status' => false, 'message' => 'Invalid email format']);
					exit;
				}

				// Use prepared statement to prevent SQL injection
				$stmt = $conn->prepare("INSERT INTO billingaddress (first_name, last_name, email, phone, address_line_1, address_line_2, country, city, state, pin_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("ssssssssss", $first_name, $last_name, $email, $phone, $address_line_1, $address_line_2, $country, $city, $state, $pin_code);

				// Execute the query
				if ($stmt->execute()) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Add billing_Address successfully";
					logMessage("Successfully inserted Billing Address: $first_name $last_name, Pin Code: $pin_code");
				} else {
					echo json_encode(['status' => false, 'message' => $stmt->error]);
					$_SESSION['msg_error'] = "Failed to insert billing_Address";
					logMessage("Failed to insert Billing Address: $first_name $last_name, Pin Code: $pin_code", 'error');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Add  billing Address End

		// Update Socail Media Start

		if ($action == "social_media_update") {
			try {
				// Get data from AJAX request and sanitize
				$website_name = ucfirst(test_input($_POST['website_name']));
				$email = ucfirst(test_input($_POST['email']));
				$location = ucfirst(test_input($_POST['location']));
				$phone = ucfirst(test_input($_POST['phone']));
				$twitter_link = ucfirst(test_input($_POST['twitter_link']));
				$facebook_link = ucfirst(test_input($_POST['facebook_link']));
				$linkedin_link = ucfirst(test_input($_POST['linkedin_link']));
				$instagram_link = ucfirst(test_input($_POST['instagram_link']));
				$google_map_link = ucfirst(test_input($_POST['google_map_link']));

				// Update data in the site_settings table using prepared statements
				$stmt = $conn->prepare("UPDATE site_settings SET website_name=?, email=?, location=?, phone=?, twitter_link=?, facebook_link=?, linkedin_link=?, instagram_link=?, google_map_link=?");
				$stmt->bind_param("sssssssss", $website_name, $email, $location, $phone, $twitter_link, $facebook_link, $linkedin_link, $instagram_link, $google_map_link);
				// Execute Statement
				if ($stmt->execute()) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Successfully updated social media data";
					logMessage("Successfully updated social media links for $website_name, Email: $email");
				} else {
					echo json_encode(['status' => false, 'message' => $stmt->error]);
					$_SESSION['msg_error'] = "Failed to update social media data";
					logMessage("Failed to update social media links for $website_name, Email: $email", 'error');
				}
			} catch (Exception $e) {
				// Catch any exceptions and log them
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}
		
		// Update Socail Media End

		// Add address Start

		if ($action == "add_address") {
			try {
				// Get data from AJAX request and sanitize
				$customer_id = $_SESSION['customer_id']; // Sanitize Customer Id
				$country = ucfirst(test_input($_POST['country'])); // Sanitize Country
				$fullname = ucfirst(test_input($_POST['fullname'])); // Sanitize Full name
				$phone = ucfirst(test_input($_POST['phone'])); // Sanitize Phone
				$pincode = ucfirst(test_input($_POST['pincode'])); // Sanitize Pin Code
				$house = ucfirst(test_input($_POST['house'])); // Sanitize house
				$street = ucfirst(test_input($_POST['street'])); // Sanitize Street
				$landmark = ucfirst(test_input($_POST['landmark']));  // Sanitize Landmark
				$town = ucfirst(test_input($_POST['town'])); // Sanitize Town
				$state = ucfirst(test_input($_POST['state'])); // Sanitize State
				$delivery = ucfirst(test_input($_POST['delivery']));  // Sanitize Delivery

				// Insert data into the customer_address table using prepared statements
				$stmt = $conn->prepare("INSERT INTO customer_address (customer_id, country, full_name, phone, pincode, house_no, street, landmark, town, state, delivery_instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("issssssssss", $customer_id, $country, $fullname, $phone, $pincode, $house, $street, $landmark, $town, $state, $delivery);
				// Execute Query
				if ($stmt->execute()) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Successfully added address";
					logMessage("Successfully added shipping address for Customer ID: $customer_id, Country: $country");
				} else {
					echo json_encode(['status' => false, 'message' => $stmt->error]);
					$_SESSION['msg_error'] = "Failed to add address";
					logMessage("Failed to insert shipping address for Customer ID: $customer_id, Country: $country", 'error');
				}
			} catch (Exception $e) {
				// Catch any exceptions and log them
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		// Add address End

		// place_order_list Start
		
		if ($action == "add_to_cart") {
			try {
				// Get data from AJAX request and sanitize
				$customer_id = $_SESSION['customer_id'];
				$product_id = test_input($_POST['product_id']);
				$total_price = test_input($_POST['total_price']);
				$stock = test_input($_POST['stock']);
				$quantity = test_input($_POST['qut']);

				// Ensure quantity is greater than zero
				if ($quantity > 0) {
					// Check if the product exists
					$product_query = "SELECT * FROM product WHERE product_id = '$product_id'";
					$product_result = $conn->query($product_query);

					if ($product_result->num_rows > 0) {
						$product_data = $product_result->fetch_assoc();
						$product_name = $product_data['product_name'];
						$product_price = $product_data['price'];
						$description = $product_data['description'];
						$product_color = $product_data['product_color'];
						$product_size = $product_data['product_size'];

						// Check if the product is already in the cart
						$cart_query = "SELECT * FROM add_to_cart WHERE product_id = '$product_id' AND customer_id = '$customer_id'";
						$cart_result = $conn->query($cart_query);

						if ($cart_result->num_rows > 0) {
							// Update the quantity in the cart
							$update_query = "UPDATE add_to_cart SET cart_qty = '$quantity' WHERE customer_id = '$customer_id' AND product_id = '$product_id'";
							if ($conn->query($update_query)) {
								echo json_encode(['status' => true]);
								$_SESSION['msg'] = "Successfully updated quantity";
								logMessage("Successfully updated quantity for Product ID: $product_id, Customer ID: $customer_id");
							} else {
								echo json_encode(['status' => false]);
								$_SESSION['msg_error'] = "Failed to update quantity";
								logMessage("Failed to update quantity for Product ID: $product_id, Customer ID: $customer_id", 'error');
							}
						} else {
							// Insert the product into the cart
							$insert_query = "INSERT INTO add_to_cart (product_id, customer_id, cart_name, cart_qty, cart_price, description, cart_color, cart_size, total_price, stock) VALUES ('$product_id', '$customer_id', '$product_name', '$quantity', '$product_price', '$description', '$product_color', '$product_size', '$total_price', '$stock')";
							if ($conn->query($insert_query)) {
								echo json_encode(['status' => true]);
								$_SESSION['msg'] = "Successfully added to cart";
								logMessage("Successfully added product to cart for Product ID: $product_id, Customer ID: $customer_id");
							} else {
								echo json_encode(['status' => false]);
								$_SESSION['msg_error'] = "Failed to add to cart";
								logMessage("Failed to add product to cart for Product ID: $product_id, Customer ID: $customer_id", 'error');
							}
						}
					} else {
						echo json_encode(['status' => false]);
						$_SESSION['msg_error'] = "Product not found";
						logMessage("Product not found for Product ID: $product_id", 'error');
					}
				} else {
					echo json_encode(['status' => false]);
					$_SESSION['msg_error'] = "Quantity should be greater than zero";
					logMessage("Invalid quantity for Product ID: $product_id, Quantity: $quantity", 'error');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}


		
		// place_order_list End

		// Delete Add To Cart Start

		if ($action == "add_to_cart_delete") {
			try {
				// Get data from AJAX request
				$cart_id = test_input($_POST['cart_id']);

				// Prepare the deletion query using a prepared statement
				$sql = "DELETE FROM add_to_cart WHERE cart_id = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("i", $cart_id);

				// Execute the prepared statement
				if ($stmt->execute()) {
					// If deletion is successful, return success status and message
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Successfully deleted item from cart";
					logMessage("Successfully deleted item from cart. Cart ID: $cart_id");
				} else {
					// If deletion fails, return false status and error message
					echo json_encode(['status' => false]);
					$_SESSION['msg_error'] = "Failed to delete item from cart";
					logMessage("Failed to delete item from cart. Cart ID: $cart_id", 'error');
				}
				// Close the prepared statement
				$stmt->close();
			} catch (Exception $e) {
				// If an exception occurs, return false status and error message
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Delete Add To Cart End
		
		// Update Add To Cart Start

		if ($action == "update_add_to_cart") {
			try {
				// Get data from AJAX request and sanitize
				$customer_id = $_SESSION['customer_id'];
				$qut = test_input($_POST['qut']);
				$total_price = test_input($_POST['total_price']);
				$product_id = test_input($_POST['product_id']);

				// Use prepared statement to prevent SQL injection
				$sql = "UPDATE add_to_cart SET cart_qty=?, total_price=? WHERE product_id=? AND customer_id=?";

				// Prepare and execute the statement
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ssss", $qut, $total_price, $product_id, $customer_id);

				if ($stmt->execute()) {
					// If update is successful, return success status and message
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Successfully updated quantity in cart";
					logMessage("Successfully updated quantity in cart. Product ID: $product_id, Customer ID: $customer_id");
				} else {
					// If update fails, return false status and error message
					echo json_encode(['status' => false]);
					$_SESSION['msg_error'] = "Failed to update quantity in cart";
					logMessage("Failed to update quantity in cart. Product ID: $product_id, Customer ID: $customer_id", 'error');
				}
				// Close the prepared statement
				$stmt->close();
			} catch (Exception $e) {
				// If an exception occurs, return false status and error message
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}
		// Update Add To Cart End
	}	

?>
