<?php	
	// Assuming you have a database connection already established
	require_once('../include/db_file/config.php');
<<<<<<< HEAD
		require_once('../include/db_file/connection_file.php');
		
		// Session Start
		
		// Session End
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$action = $_POST["action"];
			
			// Insert Query All Start ->
			
			
			// Registration  function
			 
=======
	require_once(__DIR__ . '/../include/db_file/connection_file.php');

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$action = $_POST["action"];

		//Trim Function Start

>>>>>>> b6fd1ddc7a3be8927a9b27f57c62db56a3f0fbee
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
				$fname_c = test_input($_POST["fname"]);
				$lname_c = test_input($_POST["lname"]);
				$email = test_input($_POST["email"]);
				$phone_c = test_input($_POST["phone"]);
				$address_c = test_input($_POST["address"]);
				$username = test_input($_POST["username"]);
				$password = md5(test_input($_POST["password"]));
				$otp = mt_rand(100000, 999999);
				$fname = ucfirst($fname_c);
				$lname = ucfirst($lname_c);
				$phone = ucfirst($phone_c);
				$address = ucfirst($address_c);
				if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($address) || empty($username) || empty($password))
				{
					echo "Please fill in all the required fields.";
				} 
				else 
				{
					$sql = "INSERT INTO user (fname, lname, email, phone, address, username, password, otp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
					$stmt = mysqli_prepare($conn, $sql);
					if ($stmt) 
					{
						mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $email, $phone, $address, $username, $password, $otp);

						if (mysqli_stmt_execute($stmt)) {
						$to = $email;
						$subject = "Registration Successful";
						$message = "Hello $fname $lname,\n\nYour registration is successful.\n\nDetails:\nEmail: $email\nPhone: $phone\nAddress: $address\nUsername: $username";
						$headers = "From: himanshusaini26112002@gmail.com";

						if (mail($to, $subject, $message, $headers)) {
						echo "Registration successful! Data added to the database and registration email sent.";

						// Send OTP
						$to = $email;
						$subject = "Registration OTP";
						$message = "Hello Your OTP is \n\nOTP: $otp";
						$headers = "From: himanshusaini26112002@gmail.com";

						if (mail($to, $subject, $message, $headers)){
							echo "Registration successful! ";
						} 
						else {
							echo "Error sending OTP email. Please contact support.";
						}
						} 
						else {
							echo "Error sending registration email. Please contact support.";
						}
						} 
						else {
							echo "Insert Error: " . mysqli_stmt_error($stmt);
						}
						mysqli_stmt_close($stmt);
					} 
					else 
					{
						echo "Prepare statement error: " . mysqli_error($conn);
					}
				}
			}
			catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
				echo 'Caught exception: ',  $e->getLine(), "\n";
			}	
		}
		
		// User Login End

		// Add Size Start

		if ($action == "add_size") {
			try{
				$size = test_input($_POST['size']);
				$status = test_input($_POST['status']);
				
				
				$stmt = $conn->prepare("INSERT INTO clothing_sizes (size, status) VALUES (?, ?)");
				$stmt->bind_param("ss", $size, $status);
				$stmt->execute();
				
				 if ($stmt->affected_rows > 0) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Size added successfully";
					logMessage("Successfully added size: $size");
				} else {
					echo json_encode(['status' => false, 'error' => 'Failed to add size']);
					$_SESSION['msg'] = "Failed to add size";
					logMessage("Failed to add size: $size", 'error');
				}
				$stmt->close();
			}
			catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}
		
		// Add Size End
		
		//Add Color Start

		if ($action == "add_color") {
			try {
				$color = ucfirst(test_input($_POST['color']));
				$status = test_input($_POST['status']);
				
				$sql = "INSERT INTO colors (color_name,status) VALUES (?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ss", $color, $status);
				$stmt->execute();
				
				if ($stmt->affected_rows > 0) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Color added successfully";
					logMessage("Successfully added color: " . $color);
				} else {
					echo json_encode(['status' => false]);
					$_SESSION['msg'] = "Failed to add color";
					logMessage("Failed to add color: " . $color);
				}
				$stmt->close();
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
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
				$stmt->bind_param("si", $password, $sid);
					
				// Execute the statement
				if ($stmt->execute()) {
					echo "Password successfully updated";
					logMessage("Password successfully updated");
				} else {
					echo "Error updating password: " . $conn->error;
					logMessage("Failed to update password: " . $conn->error, 'error');
				}

				// Close the statement
				$stmt->close();
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}


		
		//Reset Password Start
		
		// Update Size Start
		
		if ($action == "update_size") {
			try{
				$size = test_input($_POST['size']);
				$sid = test_input($_POST['sid']);
				$status = test_input($_POST['status']);

				$sql = "UPDATE clothing_sizes SET size=?, status=? WHERE sid=?";
				$stmt = $conn->prepare($sql);

				// Bind parameters and execute query
				$stmt->bind_param("ssi", $size, $status, $sid);
				$stmt->execute();

				// Check if the query was successful
				if ($stmt->affected_rows > 0) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Update Size successfully";
					logMessage("Successfully Updated Size: $size, Size ID: $sid");
				} else {
					echo json_encode(['status' => false]);
					$_SESSION['msg'] = "Failed to Update Size";
					logMessage("Failed to Update Size: $size, Size ID: $sid", 'error');
				}

				// Close statement
				$stmt->close();
			} catch (Exception $e) {
				// Handle exceptions
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}
		
		// Update Size End
		
		// Update Color Start

		if ($action == "update_color") {
			try {
				$color_name = ucfirst(test_input($_POST['color_name']));
				$color_id = test_input($_POST['color_id']);
				$status = test_input($_POST['status']);

				// Using prepared statement
				$stmt = $conn->prepare("UPDATE colors SET color_name=?, status=? WHERE color_id=?");
				$stmt->bind_param("ssi", $color_name, $status, $color_id);
				$stmt->execute();

				if ($stmt->affected_rows > 0) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Color updated successfully";
					logMessage("Successfully updated color. Color ID: " . $color_id);
				} else {
					echo json_encode(['status' => false]);
					$_SESSION['msg'] = "Failed to update color";
					logMessage("Failed to update color. Color ID: " . $color_id);
				}

				$stmt->close();
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}
		// Update Color Start

		// Delete size Start

		if ($action == "delete_size") {
			try {
				$sid = test_input($_POST['sid']);

				$stmt = $conn->prepare("DELETE FROM clothing_sizes WHERE sid = ?");
				$stmt->bind_param("i", $sid);

				if ($stmt->execute()) {
					if ($stmt->affected_rows > 0) {
						echo "Record deleted successfully";
						$_SESSION['msg'] = "Size deleted successfully";
						logMessage("Successfully deleted size with ID ".$sid);
					} else {
						echo "No records deleted";
						$_SESSION['msg'] = "No size deleted";
						logMessage("No records deleted for size with ID ".$sid);
					}
				} else {
					echo "Error deleting record: " . $stmt->error;
					$_SESSION['msg'] = "Error deleting size";
					logMessage("Failed to delete size with ID ".$sid);
				}

				$stmt->close();
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}
		
		// Delete size End

		// Delete color Start

		if ($action == "delete_color") {
			try {
				$color_id = test_input($_POST['color_id']);
				
				$sql = "DELETE FROM colors WHERE color_id = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("i", $color_id);

				if ($stmt->execute()) {
					echo "Record deleted successfully";
					$_SESSION['msg'] = "Delete Color successfully";
					logMessage("Successfully deleted Color with ID = ".$color_id);
				} else {
					echo "Error deleting record: " . $stmt->error;
					$_SESSION['msg'] = "Failed to delete Color";
					logMessage("Failed to delete Color with ID = ".$color_id);
				}
				$stmt->close();
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}


		// Delete color End

		// User Login Start
		
		if ($action == 'login') {
			try{
				$username = test_input($_POST['username']);
				$password = test_input(md5($_POST["password"]));
				$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					
					$row = $result->fetch_assoc();
					
					if ($row['status'] == 0) {
						$response = [
						'status' => 'error',
						'message' => 'Your ID is not active'
						];
						echo json_encode($response);
						exit;
					}
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
					// SESSION Start
					$_SESSION['customer_id'] = $customer_id;
					$_SESSION['customer_login'] = $username;
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
			catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// User Login End


		// OTP verify Start 

		if ($action == "verify_otp") {
			try {
				$userInputOTP = test_input($_POST['otp']);

				// Use prepared statements to prevent SQL injection
				$stmt = $conn->prepare("SELECT otp FROM user WHERE otp = ?");
				$stmt->bind_param("s", $userInputOTP);
				$stmt->execute();
				$stmt->store_result();

				if ($stmt->num_rows > 0) {
					$stmt->bind_result($otp);
					$stmt->fetch();

					if ($userInputOTP == $otp) {
						echo 'successful';
						logMessage("Successfully verified OTP: $userInputOTP");
					} else {
						echo 'error';
						logMessage("Failed verification of OTP: $userInputOTP");
					}
				} else {
					echo 'error';
					logMessage("No matching OTP found: $userInputOTP");
				}

				$stmt->close();
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// OTP verify End 

		// OTP Random Link Start
		
		if ($action == "random_link") {
			try {
				$email = test_input($_POST["email"]);

				// Validate email format
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					die("Invalid email address");
				}

				// Prepare SQL statement to prevent SQL injection
				$stmt = $conn->prepare("SELECT sid FROM user WHERE email = ?");
				$stmt->bind_param("s", $email);
				$stmt->execute();
				$result = $stmt->get_result();

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();

					$id = $row['sid'];
					$ids = base64_encode($id);
					$sid = bin2hex($ids);
					
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
					echo "Error: No user found with the provided email.";
					logMessage("No user found with the provided email: ".$email);
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// OTP Random Link End
		
		// Admin Login Start
		
		if ($action == "admin_login") {
			try {
				// Get form data
				$admin_name = test_input($_POST['admin_name']);
				$admin_password = test_input($_POST['admin_password']);

				// Prepare and bind parameters
				$stmt = $conn->prepare("SELECT * FROM admin WHERE name = ? AND password = ?");
				$stmt->bind_param("ss", $admin_name, $admin_password);
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
					$cname_c = test_input($_POST['cname']);
					$cname = ucfirst($cname_c);
					$cimg = test_input($_FILES['cimg']['name']);

					$uploadDir = '../admin/assets/upload_img/';
					$uploadedFile = $uploadDir . basename($_FILES['cimg']['name']);

					if(move_uploaded_file($_FILES['cimg']['tmp_name'], $uploadedFile)) {
						$status = test_input($_POST['status']);

						// Using prepared statements for security
						$stmt = $conn->prepare("INSERT INTO category (cname, cimg, status) VALUES (?, ?, ?)");
						$stmt->bind_param("sss", $cname, $cimg, $status);

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
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Add category End

		// Show Data Category Start 

		if ($action == "fetch_data") {
			try {
				$sql = "SELECT * FROM category";
				$result = mysqli_query($conn, $sql);

				if (!$result) {
					throw new Exception("SQL query failed: " . mysqli_error($conn));
				}

				$output = "";
				if (mysqli_num_rows($result) > 0) {
					$output = '<table border="1" width="100%" cellspacing="0" cellpadding="10" class="category_table_style">';
					$output .= '<tr>
									<th>cid</th>
									<th>cname</th>
									<th>cimg</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>';

					while ($row = mysqli_fetch_assoc($result)) {
						$output .= "<tr>
										<td>{$row['cid']}</td>
										<td>{$row['cname']}</td>
										<td>{$row['cimg']}</td>
										<td><a class='btn btn-success' href='update_category.php?cid={$row['cid']}'>Update</a></td>
										<td><a class='btn btn-danger' href='delete_category.php?cid={$row['cid']}'>Delete</a></td>
									</tr>";
					}
					$output .= "</table>";
					echo $output;
				} else {
					echo "No records found";
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Show Data Category End 
		
		// Show data Size Start
		
		if ($action == "fetch_size") {
			try {
				$sql = "SELECT * FROM clothing_sizes";
				$result = mysqli_query($conn, $sql);

				if (!$result) {
					throw new Exception("SQL query failed: " . mysqli_error($conn));
				}

				$output = "";
				if (mysqli_num_rows($result) > 0) {
					$output = '<table border="1" width="100%" cellspacing="0" cellpadding="10" class="category_table_style">';
					$output .= '<tr>
									<th>sid</th>
									<th>size</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>';

					while ($row = mysqli_fetch_assoc($result)) {
						$output .= "<tr>
										<td>{$row['sid']}</td>
										<td>{$row['size']}</td>
										<td><a class='btn btn-success' href='update_size.php?sid={$row['sid']}'>Update</a></td>
										<td><a class='btn btn-danger' href='delete_size.php?sid={$row['sid']}'>Delete</a></td>
									</tr>";
					}
					$output .= "</table>";

					echo $output;
				} else {
					echo "No records found";
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Show data Size End

		// Show data Color Start
		if ($action == "fetch_color") {
			try {
				$sql = "SELECT * FROM colors";
				$result = mysqli_query($conn, $sql);

				if (!$result) {
					throw new Exception("SQL query failed: " . mysqli_error($conn));
				}

				$output = "";
				if (mysqli_num_rows($result) > 0) {
					$output = '<table border="1" width="100%" cellspacing="0" cellpadding="10" class="category_table_style">';
					$output .= '<tr>
									<th>color_id</th>
									<th>Color Name</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>';

					while ($row = mysqli_fetch_assoc($result)) {
						$output .= "<tr>
										<td>{$row['color_id']}</td>
										<td>{$row['color_name']}</td>
										<td><a class='btn btn-success' href='update_color.php?color_id={$row['color_id']}'>Update</a></td>
										<td><a class='btn btn-danger' href='delete_color.php?color_id={$row['color_id']}'>Delete</a></td>
									</tr>";
					}
					$output .= "</table>";

					echo $output;
				} else {
					echo "No records found";
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Show data Color End
		
		// Delete Category Start

		if ($action == "delete_category") {
			try {
				$cid = test_input($_POST['cid']);

				// Use prepared statement for security
				$stmt = $conn->prepare("DELETE FROM category WHERE cid = ?");
				$stmt->bind_param("i", $cid);

				if ($stmt->execute()) {
					echo "Record deleted successfully";
					$_SESSION['msg'] = "Delete Categories successfully";
					logMessage("Successfully deleted Category = " . $cid);
				} else {
					echo "Error deleting record: " . $stmt->error;
					$_SESSION['msg_error'] = "Failed to delete Category";
					logMessage("Failed to delete Category = " . $cid, 'error');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Delete Category End
		
		// Update Category Start

		if ($action == "update_category") {
			try {
				// Get data from AJAX request
				$cname_c = test_input($_POST['cname']);
				$cname = ucfirst($cname_c);
				$status = test_input($_POST['status']);
				$cid = test_input($_POST['cid']);

				// Check if a file is uploaded
				if (!empty($_FILES['cimg']['name'])) {
					$cimg = test_input($_FILES['cimg']['name']);
					$uploadDir = '../admin/assets/upload_img/';
					$uploadedFile = $uploadDir . basename($_FILES['cimg']['name']);
					move_uploaded_file($_FILES['cimg']['tmp_name'], $uploadedFile);
				} else {
					// If no file is uploaded, retain the existing image name
					$folder_img = "SELECT cimg FROM category WHERE cid=?";
					$stmt = $conn->prepare($folder_img);
					$stmt->bind_param("i", $cid);
					$stmt->execute();
					$res = $stmt->get_result();
					$row = $res->fetch_assoc();
					$cimg = test_input($row['cimg']);
				}

				// Use prepared statement to prevent SQL injection
				$sql = "UPDATE category SET cname=?, cimg=?, status=? WHERE cid=?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("sssi", $cname, $cimg, $status, $cid);

				if ($stmt->execute()) {
					echo json_encode(['status' => true]);
					$_SESSION['msg'] = "Update Categories successfully";
					logMessage("Successfully updated Category: " . $cname . " (Category ID: " . $cid . ")");
				} else {
					echo json_encode(['status' => false]);
					$_SESSION['msg_error'] = "Failed to update Categories";
					logMessage("Failed to update Category: " . $cname . " (Category ID: " . $cid . ")", 'error');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}

		
		// Update Category End

		// Add product  Start

		if ($action == "add_product") {
			try{
				// Get data from AJAX request
				$category_c = test_input($_POST['category']);
				$category = ucfirst($category_c);
				$product_color = test_input($_POST['product_color']);
				$product_size = test_input($_POST['product_size']);
				$product_stock = test_input($_POST['product_stock']);
				$price = test_input($_POST['price']);
				$product_name_c = test_input($_POST['product_name']);
				$product_name = ucfirst($product_name_c);
				$description_c = test_input($_POST['description']);
				$description = ucfirst($description_c);
				$status = test_input($_POST['status']);

				// Array to store uploaded file names

				$product_imgs = array();

				// Process multiple file uploads

				if (!empty($_FILES['product_img']['name'][0])) {
					$uploadDir = '../admin/assets/upload_img/';
					foreach ($_FILES['product_img']['name'] as $key => $name) {
					$tmp_name = $_FILES['product_img']['tmp_name'][$key];
					$newFileName = $uploadDir . basename($name);
					if (move_uploaded_file($tmp_name, $newFileName)) {
						$product_imgs[] = $newFileName;
					} else {
						echo "Error uploading file: " . $name;
					}
					}
				}

				$sql = "INSERT INTO product (category,product_color,product_size,stock,price,product_name,description,product_img,status) VALUES ('$category','$product_color','$product_size','$product_stock','$price','$product_name','$description','" . implode(',', $product_imgs) . "','$status')";

				if ($conn->query($sql) === TRUE) {
					echo json_encode(["status"=>true]);
					$_SESSION['msg'] = "Add Data Successfully";
					logMessage("successfully Add Product ".$product_name." category Id = ".$category );
				} else {
					echo json_encode(["status"=>false]);
					$_SESSION['msg_error'] = "Do not Add Data ";
					logMessage("Failed Do Not Add Product ".$product_name." category Id = ".$category);
				}
			}
			catch (Exception $e) {
				echo json_encode(['status' => false, 'message' => 'An error occurred']);
				logMessage("Exception caught: " . $e->getMessage(), 'error');
				logMessage("Line: " . $e->getLine(), 'error');
			}
		}


		// Update Product Start

		if ($action == "update_product") {
			try {
				// Get data from AJAX request
				$product_id = test_input($_POST['product_id']);
				$category = test_input($_POST['category']);
				$product_color = test_input($_POST['product_color']);
				$product_size = test_input($_POST['product_size']);
				$price = test_input($_POST['price']);
				$product_name = test_input($_POST['product_name']);
				$description = test_input($_POST['description']);
				$status = test_input($_POST['status']);

				// Array to store uploaded file names
				$product_imgs = array();

				if (!empty($_FILES['product_img']['name'][0])) {
					$uploadDir = '../admin/assets/upload_img/';
					foreach ($_FILES['product_img']['name'] as $key => $name) {
						$tmp_name = $_FILES['product_img']['tmp_name'][$key];
						$filename = $uploadDir . basename($name);
						
						// Validate file type and move file
						$fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
						if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']) && $_FILES['product_img']['size'][$key] < 5000000) {
							if (move_uploaded_file($tmp_name, $filename)) {
								$product_imgs[] = $filename;
							} else {
								throw new Exception("Error uploading file: " . $name);
							}
						} else {
							throw new Exception("Invalid file type or file size exceeds the limit for file: " . $name);
						}
					}
					$product_img = implode(',', $product_imgs);
				} else {
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
				$product_id = test_input($_POST['product_id']);

				// Use prepared statement to prevent SQL injection
				$stmt = $conn->prepare("DELETE FROM product WHERE product_id=?");
				$stmt->bind_param("i", $product_id);

				if ($stmt->execute()) {
					echo "Record deleted successfully";
					$_SESSION['msg'] = "Delete Data Successfully";
					logMessage("Successfully deleted Product ID: " . $product_id);
				} else {
					echo "Error deleting record: " . $stmt->error;
					$_SESSION['msg_error'] = "Failed to delete Product";
					logMessage("Failed to delete Product ID: " . $product_id, 'error');
				}
			} catch (Exception $e) {
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

				// Insert data into the site_settings table using prepared statements
				$stmt = $conn->prepare("UPDATE site_settings SET website_name=?, email=?, location=?, phone=?, twitter_link=?, facebook_link=?, linkedin_link=?, instagram_link=?, google_map_link=?");
				$stmt->bind_param("sssssssss", $website_name, $email, $location, $phone, $twitter_link, $facebook_link, $linkedin_link, $instagram_link, $google_map_link);

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
				$customer_id = $_SESSION['customer_id'];
				$country = ucfirst(test_input($_POST['country']));
				$fullname = ucfirst(test_input($_POST['fullname']));
				$phone = ucfirst(test_input($_POST['phone']));
				$pincode = ucfirst(test_input($_POST['pincode']));
				$house = ucfirst(test_input($_POST['house']));
				$street = ucfirst(test_input($_POST['street']));
				$landmark = ucfirst(test_input($_POST['landmark']));
				$town = ucfirst(test_input($_POST['town']));
				$state = ucfirst(test_input($_POST['state']));
				$delivery = ucfirst(test_input($_POST['delivery']));

				// Insert data into the customer_address table using prepared statements
				$stmt = $conn->prepare("INSERT INTO customer_address (customer_id, country, full_name, phone, pincode, house_no, street, landmark, town, state, delivery_instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("issssssssss", $customer_id, $country, $fullname, $phone, $pincode, $house, $street, $landmark, $town, $state, $delivery);

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
