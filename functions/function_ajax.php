<?php	
	// Assuming you have a database connection already established
	
		require_once('../include/db_file/config.php');
		require_once('../include/db_file/connection_file.php');
		
		// Session Start
		
		// Session End
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$action = $_POST["action"];
			
			// Insert Query All Start ->
			
			
			// Registration  function
			 
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			// Define logging function
			function logMessage($message, $type = 'info') {
				
			// Log file path
				$logFile = '../admin/logs/log.txt';
			// Current timestamp
			
			//Time Zone Start
				$newTimeZone = 'Asia/Kolkata'; // India time zone
				date_default_timezone_set($newTimeZone);

				$currentTimeZone = date_default_timezone_get();
				$Datetamp = date('Y-m-d');
				$Timetamp = date('H:i:s');
			//Time Zone End
			
			// Format the log message
				$logMessage = "Today Date:- [$Datetamp] & Time:- [$Timetamp] & Type:- [$type] $message " . PHP_EOL;
			// Append the log message to the log file
				$result = file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
				
				if(!$result == false)
				{
					return true;
				}
				else{
					return false;
				}
			}
			if ($action == "register") {
				
				try{
					// Validate input
					$fname_c = test_input($_POST["fname"]);
					$lname_c = test_input($_POST["lname"]);
					$email = test_input($_POST["email"]);
					$phone_c = test_input($_POST["phone"]);
					$address_c = test_input($_POST["address"]);
					$username = test_input($_POST["username"]);
					$password = md5(test_input($_POST["password"]));
					$otp = mt_rand(100000, 999999);
					//capital character Start
					
					$fname = ucfirst($fname_c);
					$lname = ucfirst($lname_c);
					$phone = ucfirst($phone_c);
					$address = ucfirst($address_c);
					
					//capital character End
					
					// Check for empty fields
					if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($address) || empty($username) || empty($password)) {
						echo "Please fill in all the required fields.";
					} else {
						// Perform data insertion logic into users table using prepared statements
						$sql = "INSERT INTO user (fname, lname, email, phone, address, username, password, otp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
						$stmt = mysqli_prepare($conn, $sql);

						if ($stmt) {
							mysqli_stmt_bind_param($stmt, "ssssssss", $fname, $lname, $email, $phone, $address, $username, $password, $otp);

							if (mysqli_stmt_execute($stmt)) {
								// Send registration email
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
							mysqli_stmt_close($stmt);
						} else {
							echo "Prepare statement error: " . mysqli_error($conn);
						}
					}
				}
				catch(Exception $e){
					echo 'Caught exception: ',  $e->getMessage(), "\n";
					echo 'Caught exception: ',  $e->getLine(), "\n";
				}
			}

			
			//Add Size 
			
			if ($action == "add_size") {
				
				try{
					// Get data from AJAX request
					$size = test_input($_POST['size']);
					$status = test_input($_POST['status']);
					// Insert data into the category table

					$sql = "INSERT INTO clothing_sizes (size,status) VALUES ('$size','$status')";

					if ($conn->query($sql) === TRUE) {
						echo json_encode(['status' => true]);
						$_SESSION['msg'] = "Add Size successfully";
						logMessage("successfully Add Size = ".$size);
					} else {
						echo json_encode(['status' => false]);
						$_SESSION['msg'] = "Do not Add Size ";
						logMessage("Failed Do Not Add Size = ".$size);
					}
				}
				 catch (Exception $e) {
					echo json_encode(['status' => false, 'message' => 'An error occurred']);
					logMessage("Exception caught: " . $e->getMessage(), 'error');
					logMessage("Line: " . $e->getLine(), 'error');
				}
				
			}
			
			//Add Color 
				
			if ($action == "add_color") {
				try{
					// Get data from AJAX request
					$color_c= test_input($_POST['color']);
					$color = ucfirst($color_c);
					$status = test_input($_POST['status']);
					// Insert data into the category table
					$sql = "INSERT INTO colors (color_name,status) VALUES ('$color','$status')";
					if ($conn->query($sql) === TRUE) {
						echo json_encode(['status' => true]);
						$_SESSION['msg'] = "Add Color successfully";
						logMessage("successfully Add Color = ".$color);
					} else {
						echo json_encode(['status' => false]);
						$_SESSION['msg'] = "Do Not Add Color ";
						logMessage("Failed Do Not Add Color = ".$color );
					}
				}
				catch(Exception $e) {
					echo json_encode(['status' => false, 'message' => 'An error occurred']);
					logMessage("Exception caught: " . $e->getMessage(), 'error');
					logMessage("Line: " . $e->getLine(), 'error');
				}
			}
			
			
			// Insert Query All End ->
			
			// Update Query All Start ->
			
				if ($action == "confrom_pass") {
					try{
						// Check if the OTP is provided
						$password = test_input(md5($_POST['password']));

						// Update the user information in the database
						$sql = "UPDATE user SET password='$password' WHERE sid='1'";

						if ($conn->query($sql) === TRUE) {
							echo "successfully";
							logMessage("successfully Update Password = ".$password );
							
						} else {
							echo "Error updating record: " . $conn->error;
							logMessage("Failed Do Not update Password = ".$password);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

						
				}
				// Update size
				
				if ($action == "update_size") {
					try{
						// Get data from AJAX request
						$size = test_input($_POST['size']);
						$sid = test_input($_POST['sid']);
						$status = test_input($_POST['status']);
						// Insert data into the category table

						$sql = "UPDATE clothing_sizes SET size='$size',status='$status' where sid='$sid'";

						if ($conn->query($sql) === TRUE) {
							echo json_encode(['status' => true]);
							$_SESSION['msg'] = "Update Size successfully";
							logMessage("successfully Update Size ".$size." Size Id = ".$sid);
						} else {
							echo json_encode(['status' => false]);
							$_SESSION['msg'] = "Do not Update Size";
							logMessage("Failed Do Not Update Size ".$size." Size Id = ".$sid);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

						
				}
				
				
				// Update Color
				
				if ($action == "update_color") {
					
					try{
						// Get data from AJAX request
						$color_name_c = test_input($_POST['color_name']);
						$color_name = ucfirst($color_name_c);
						
						$color_id = test_input($_POST['color_id']);
						$status = test_input($_POST['status']);
						// Insert data into the category table

						$sql = "UPDATE colors SET color_name='$color_name',status='$status' where color_id='$color_id'";
						
						if ($conn->query($sql) === TRUE) {
							echo json_encode(['status' => true]);
							$_SESSION['msg'] = "Update Color successfully";
							logMessage("successfully Update Color ".$color." Color Id = ".$color_id);
						} else {
							echo json_encode(['status' => false]);
							$_SESSION['msg'] = "Do not Update color";
							logMessage("Failed Do Not Update Color ".$color." Color Id = ".$color_id);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

				
				}
				
			
			// Update Query All End ->
			
			
			// Delete Query All Start ->
			
			
				// Delete size
				
				if ($action == "delete_size") {
					
					try{
						$sid = test_input($_POST['sid']);

						// Perform the deletion query (Example, please use prepared statements for security)
						$sql = "DELETE FROM clothing_sizes WHERE sid = $sid";

						if (mysqli_query($conn, $sql)) {
							echo "Record deleted successfully";
							$_SESSION['msg'] = "Delete Size successfully";
							logMessage("successfully Delete Size Id ".$sid);
						} else {
							echo "Error deleting record: " . mysqli_error($conn);
							$_SESSION['msg'] = "Do Not Delete Size ";
							logMessage("Failed Do Not Delete Size Id = ".$sid);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

				
				}
				
				
				// Delete color
				
				if ($action == "delete_color") {
					
					try{
						 $color_id = test_input($_POST['color_id']);

						// Perform the deletion query (Example, please use prepared statements for security)
						$sql = "DELETE FROM colors WHERE color_id = $color_id";

						if (mysqli_query($conn, $sql)) {
							echo "Record deleted successfully";
							$_SESSION['msg'] = "Delete Color successfully";
							logMessage("successfully Delete Color Id = ".$color_id);
						} else {
							echo "Error deleting record: " . mysqli_error($conn);
							$_SESSION['msg'] = " Do not Delete Color";
							logMessage("Failed Do Not Delete Color Id = ".$color_id);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

						
				}
				
				
			// Delete Query All End ->
			
			
			// Select Query All Start ->
			
				// Login  function
				
				  if ($action == 'login') {
					  
					  try{
								// Retrieve data from POST request
							$username = test_input($_POST['username']);
							$password = test_input(md5($_POST["password"]));
							// SQL query to check username and password
							$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// Authentication successful
								$row = $result->fetch_assoc();

								// Check the status of the user
								if ($row['status'] == 0) {
									// User is not active, show alert
									$response = [
										'status' => 'error',
										'message' => 'Your ID is not active'
									];

									echo json_encode($response);
									exit; // Stop further execution
								}

								// Fetch additional data
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

					
					
					// verify_otp  function
			
					 if ($action == "verify_otp") {
						 
						try{
							// Check if the OTP is provided
						
							$userInputOTP = test_input($_POST['otp']);

							// Prepare and execute the SQL statement using prepared statements
							$sql = "SELECT otp FROM user WHERE otp = '$userInputOTP'";
							
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								$otp = $row['otp'];
								if($userInputOTP == $otp)
								{
									echo 'successful';
									logMessage("successfully generate OTP = ".$userInputOTP);
								}
							}
							else{
								  echo 'error';
									logMessage("Failed Do Not generate OTP = ".$userInputOTP);
							}
						}
						catch (Exception $e) {
							echo json_encode(['status' => false, 'message' => 'An error occurred']);
							logMessage("Exception caught: " . $e->getMessage(), 'error');
							logMessage("Line: " . $e->getLine(), 'error');
						}

								
					}
					
					
					
					// verify_otp  function
			
					 if ($action == "random_link") 
					 {
						try{
							// Check if the OTP is provided
							$email = test_input($_POST["email"]);

							// Validate email (you might want to add more robust validation)
							if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								die("Invalid email address");
							}

							$sql = "SELECT sid FROM user WHERE email = '$email'";
							
							$result = mysqli_query($conn, $sql);

								if(mysqli_num_rows($result) > 0)
								{
									$row = mysqli_fetch_assoc($result);
									
									$id = $row['sid'];
									$ids = base64_encode($id);
									$sid = bin2hex($ids);
									//echo "successfully!";
									$token = uniqid();
								
								  $resetLink = "http://localhost/online-shoping/reset_password/conform_password.php?sid=$sid&email=$email&token=".uniqid();
									echo $resetLink;die();
									// Send the link to the user's email (use a proper mail library in production)
									mail($email, "Password Reset", "Click the link to reset your password: $resetLink");
									logMessage("successfully Sand OTP Link = ".$email);
								}
							 else {
								echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								logMessage("Failed Do Not Sand Link = ".$email);
							}
						}
						catch (Exception $e) {
							echo json_encode(['status' => false, 'message' => 'An error occurred']);
							logMessage("Exception caught: " . $e->getMessage(), 'error');
							logMessage("Line: " . $e->getLine(), 'error');
						}

							
					}
					// admin Login
				
					  if ($action == "admin_login") {
						  
						  try{
								// Get form data
								$admin_name = test_input($_POST['admin_name']);
								$admin_password = test_input($_POST['admin_password']);

								

								// Perform a simple SQL query without prepared statement (not recommended for production due to SQL injection risk)
								$sql = "SELECT * FROM admin WHERE name = '$admin_name' AND password ='$admin_password'";
								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								 $name = $row['name'];
									
								if ($name == $admin_name) {
									
										// Start a session and set session variables
										$_SESSION['admin_name'] = $admin_name;

										// Explicitly set the content type to JSON
										header('Content-Type: application/json');
										echo json_encode(["status" => "success"]);
										logMessage("successfully Admin Login = ".$name);
									
								} else {
									// Provide a generic error message
									header('Content-Type: application/json');
									echo json_encode(["status" => "error", "message" => "Error executing the query"]);
									logMessage("Failed Do Not Fetch Admin Login Data = ".$name);
								}
							}
							catch (Exception $e) {
								echo json_encode(['status' => false, 'message' => 'An error occurred']);
								logMessage("Exception caught: " . $e->getMessage(), 'error');
								logMessage("Line: " . $e->getLine(), 'error');
							}

						
					  }
					
			// Select Query All End ->
			
			
			// Fetch Query All Start ->
				// Add category 
					
					if ($action == "category") {
						
						try{
							// Get data from AJAX request
							if(!empty($_POST['cname']) && !empty($_FILES['cimg']['name'])){
								
								$cname_c = test_input($_POST['cname']);
								$cname = ucfirst($cname_c);
								$cimg = test_input($_FILES['cimg']['name']);
								$uploadDir = '../admin/assets/upload_img/';
								$uploadedFile = $uploadDir . basename($_FILES['cimg']['name']);
								move_uploaded_file($_FILES['cimg']['tmp_name'],$uploadedFile);
								
								
								$status = test_input($_POST['status']);
								// Insert data into the category table

								$sql = "INSERT INTO category (cname, cimg ,status) VALUES ('$cname', '$cimg', '$status')";

								if ($conn->query($sql) === TRUE) {
									echo json_encode(['status' => true]);
									$_SESSION['msg'] = "Add Categories successfully";
									 logMessage("successfully Add Category = ".$cname);
								} else {
									echo json_encode(['status' => false]);
									$_SESSION['msg_error'] = "Do Not Add Categories ";
									 logMessage("Failed Do Not add Category = ".$cname);
								}
							}else{
								 throw new Exception("cname and cimg should not be empty.");
								  logMessage("Failed Value is empty", 'error');
							}
							
						}
						catch (Exception $e) {
							echo json_encode(['status' => false, 'message' => 'An error occurred']);
							logMessage("Exception caught: " . $e->getMessage(), 'error');
							logMessage("Line: " . $e->getLine(), 'error');
						}

						
					}
			
				// Fetch Category 
					
					if ($action == "fetch_data") {
						
						try{
								$sql = "select * from category";
								$result = mysqli_query($conn, $sql) or die("sql query failed");
								$output = "";
								if (mysqli_num_rows($result) > 0) {
									$output = '<table border="1" width="100" cellspacing="0" cellpadding="10px" class="category_table_style">
									<tr>
									<th>cid</th>
									<th>cname</th>
									<th>cimg</th>
									<th>Update </th>
									<th>Delete</th>
									</tr>';
									while ($row = mysqli_fetch_assoc($result))
									//print_r($row);exit;
									{
										$output .= "<tr>
										<td>{$row['cid']}</td>
										<td>{$row['cname']}</td>
										<td>{$row['cimg']}</td>
										<td><a class='btn btn-success' href='update_category.php?cid={$row['cid']}'>Update</a></td>
										 <td><a class='btn btn-danger' href='delete_category.php?cid={$row['cid']}'>delete</a></td>
										</tr>";
									}
									$output .= "</table>";
									echo $output;
								} else {
									echo "no record found";
								}
						}
						catch (Exception $e) {
							echo json_encode(['status' => false, 'message' => 'An error occurred']);
							logMessage("Exception caught: " . $e->getMessage(), 'error');
							logMessage("Line: " . $e->getLine(), 'error');
						}

							
					}
			
				// Fetch Size 
					if ($action == "fetch_size") {
						
						try{
							$sql = "select * from clothing_sizes";
							$result = mysqli_query($conn, $sql) or die("sql query failed");
							$output = "";
							if (mysqli_num_rows($result) > 0) {
								$output = '<table border="1" width="100" cellspacing="0" cellpadding="10px" class="category_table_style">
								<tr>
								<th>sid</th>
								<th>size</th>
								<th>Update </th>
								<th>Delete</th>
								</tr>';
								while ($row = mysqli_fetch_assoc($result))
								//print_r($row);exit;
								{
									$output .= "<tr>
									<td>{$row['sid']}</td>
									<td>{$row['size']}</td>
									<td><a class='btn btn-success' href='update_size.php?sid={$row['sid']}'>Update</a></td>
									 <td><a class='btn btn-danger' href='delete_size.php?sid={$row['sid']}'>delete</a></td>
									</tr>";
								}
								$output .= "</table>";

								echo $output;
							} else {
								echo "no record found";
							}
						}
						catch (Exception $e) {
							echo json_encode(['status' => false, 'message' => 'An error occurred']);
							logMessage("Exception caught: " . $e->getMessage(), 'error');
							logMessage("Line: " . $e->getLine(), 'error');
						}

						
					}
				
				// Fetch color 
					if ($action == "fetch_color") {
						try{
							$sql = "select * from colors";
								$result = mysqli_query($conn, $sql) or die("sql query failed");
								$output = "";
								if (mysqli_num_rows($result) > 0) {
									$output = '<table border="1" width="100" cellspacing="0" cellpadding="10px" class="category_table_style">
									<tr>
									<th>sid</th>
									<th>Color Name</th>
									<th>Update</th>
									<th>Delete</th>
									</tr>';
									while ($row = mysqli_fetch_assoc($result))
									//print_r($row);exit;
									{
										$output .= "<tr>
										<td>{$row['color_id']}</td>
										<td>{$row['color_name']}</td>
										<td><a class='btn btn-success' href='update_color.php?color_id={$row['color_id']}'>Update</a></td>
										 <td><a class='btn btn-danger' href='delete_color.php?color_id={$row['color_id']}'>delete</a></td>
										</tr>";
									}
									$output .= "</table>";

									echo $output;
								} else {
									echo "no record found";
								}
						}
						catch (Exception $e) {
							echo json_encode(['status' => false, 'message' => 'An error occurred']);
							logMessage("Exception caught: " . $e->getMessage(), 'error');
							logMessage("Line: " . $e->getLine(), 'error');
						}
					}
			
			// Fetch Query All End ->
				
				// Admin Data Category Start
				
				
				
				// Delete Category
				
				if ($action == "delete_category") {
					try{
						 $cid = test_input($_POST['cid']);
						// Perform the deletion query (Example, please use prepared statements for security)
						$sql = "DELETE FROM category WHERE cid = $cid";

						if (mysqli_query($conn, $sql)) {
							echo "Record deleted successfully";
							$_SESSION['msg'] = "Delete Categories successfully";
							logMessage("successfully Delete Category = ".$cid);
						} else {
							echo "Error deleting record: " . mysqli_error($conn);
							$_SESSION['msg_error'] = "Do Not Delete Categories ";
							logMessage("Failed Do Not Delete Category = ".$cid);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

						
				}
				
				// Update Category
				
				if ($action == "update_category") {
					
					try{
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
							$folder_img = "SELECT cimg FROM category WHERE cid='$cid'";
							$res = $conn->query($folder_img);
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
							logMessage("successfully Update Category ".$cname." Category Id = ".$cid);
						} else {
							echo json_encode(['status' => false]);
							$_SESSION['msg_error'] = "Do Not Update Categories";
							logMessage("Failed Do Not Update Category ".$cname." Category Id = ".$cid);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}
				}
			
			// Admin Data Category 
				
				// Admin Data Product Start
				
				// Add product 
				
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
						
						// Insert data into the product table
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

				
				// Update Product
				
				if ($action == "update_product") {
					
					try{
						// Get data from AJAX request
						$product_id = test_input($_POST['product_id']);
						$category = test_input($_POST['category']);
						$product_color = test_input($_POST['product_color']);
						$product_size = test_input($_POST['product_size']);
						$price = test_input($_POST['price']);
						$product_name = test_input($_POST['product_name']);
						$description = test_input($_POST['description']);
						$status = test_input($_POST['status']);

						$product_imgs = array();
						
						if(!empty($_FILES['product_img']['name'][0]))
						{
							$uploadDir = '../admin/assets/upload_img/';
							foreach($_FILES['product_img']['name'] as $key=>$name)
							{
								$tmp_name = $_FILES['product_img']['tmp_name'][$key];
								$filename = $uploadDir . basename($name);
								if(move_uploaded_file($tmp_name,$filename))
								{
									$product_imgs[] = $filename;
									$product_img = implode(',',$product_imgs);
								}else{
									echo "Error uploading file: " . $name;
								}
								
							}
						}
						else {
							// If no file is uploaded, retain the existing image name
							$folder_img = "SELECT product_img FROM product WHERE product_id=?";
							$stmt_folder = $conn->prepare($folder_img);
							$stmt_folder->bind_param("i", $product_id);
							$stmt_folder->execute();
							$stmt_folder->bind_result($existing_img);
							$stmt_folder->fetch();
							$product_img = $existing_img;
							$stmt_folder->close();
						}

						// Use prepared statement to prevent SQL injection
						$sql = "UPDATE product SET category='$category', product_color='$product_color', product_size='$product_size', price='$price', product_name='$product_name', description='$description', product_img='$product_img', status='$status' WHERE product_id='$product_id'";
						
						if ($result = $conn->query($sql) === TRUE) {
							
							echo json_encode(["status"=>true]);
							$_SESSION['msg'] = "Update Data Successfully";
							logMessage("successfully Update Product ".$product_name." Category Id = ".$category);
							
						} else {
							echo json_encode(["status"=>false]);
							$_SESSION['msg_error'] = "Do not Update Product";
							logMessage("Failed Do Not Update Product ".$product_name." Category Id = ".$category);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

					

				}
				
				
				// Delete product
				
				if ($action == "delete_product") {
					
					
					try{
						 $product_id = test_input($_POST['product_id']);
						// Perform the deletion query (Example, please use prepared statements for security)
						$sql = "DELETE FROM product WHERE product_id='$product_id'";

						if (mysqli_query($conn,$sql)) {
							echo "Record deleted successfully";
							$_SESSION['msg'] = "Delete Data Successfully";
							logMessage("successfully Delete Product Id = ".$product_id );
						} else {
							echo "Error deleting record: " . mysqli_error($conn);
							$_SESSION['msg_error'] = "Do Not Delete Product";
							logMessage("Failed Do Not Delete Product = ".$product_id);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

					
				}
				
			// Admin Data Product End
			
			
			// Customer contact
			
			if ($action == "contact") {
				try{
					// Set parameters and execute
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$email = $_POST['email'];
					$phone = $_POST['phone'];
					$message = $_POST['message'];
		
					// Session Start
					
					$_SESSION['customer_name'] = $fname;
					//Session End 
					
					// Prepare and bind the SQL statement
					$sql = "INSERT INTO customer_contact (fname, lname, email, phone, message) VALUES ('$fname','$lname','$email','$phone','$message')";
					
					 if ($result = $conn->query($sql) === true) {
						// If insertion is successful, send email and return 'success'
						$to = "recipient@example.com"; // Change this to your email address
						$subject = "New Contact Form Submission";
						$body = "First Name: $fname\nLast Name: $lname\nEmail: $email\nPhone: $phone\nMessage: $message";
						$headers = "From: $email";

						if (mail($to, $subject, $body, $headers)) {
							echo json_encode(['status' => true]);
							logMessage("successfully Add Contact ".$fname." ".$lname." Email = " .$email);
							
						} else {
							// If email sending fails, return an error message
							echo json_encode(['status' => false, 'message'=>'Error sending email']);
							logMessage("Failed Do Not Insert Contact ".$fname." ".$lname." Email = " .$email);
						}
					} else {
						// If insertion fails, return an error message
						echo json_encode(['status'=>false, 'message'=>'Error inserting into database']);
						$_SESSION['msg_error'] = "Error";
						logMessage("Failed Do Not Generate Query In Contact Function ", 'error');
					}
				}
				catch (Exception $e) {
					echo json_encode(['status' => false, 'message' => 'An error occurred']);
					logMessage("Exception caught: " . $e->getMessage(), 'error');
					logMessage("Line: " . $e->getLine(), 'error');
				}

				
			} 
			
			// Update User
				
			if ($action == "update_user") {
				try{
					// Get data from AJAX request
					$email = test_input($_POST['email']);
					$status = test_input($_POST['status']);
					$sid = test_input($_POST['sid']);
					// Use prepared statement to prevent SQL injection
					if ($status == 1) {
						// Set up email parameters
						$to = $email;
						$subject = "Your account is now active";
						$message = "Dear user,\n\nYour account is now active. Thank you for joining us!";
						$headers = "From: himanshusaini26112002@gmail.com";

						// Send the email
						if (mail($to, $subject, $message, $headers)) {
							$sql = "UPDATE user SET status=? WHERE sid=?";
							$stmt = $conn->prepare($sql);
							$stmt->bind_param("si", $status, $sid);
							if ($stmt->execute()) {
								echo json_encode(['status' => '1']);
								if($status == '1')
								{
									$_SESSION['msg'] = "Active Id successfully";
								}
								else{
									$_SESSION['msg'] = " Do not Active Id";
								}
							} else {
								echo json_encode(['status' => false, 'error' => $stmt->error]);
							}
									
						} else {
							echo "<script>alert('Failed to send email.')</script>";
							$_SESSION['msg_error'] = "Error";
						}
					}
					else{
						$sql = "UPDATE user SET status=? WHERE sid=?";
						$stmt = $conn->prepare($sql);
						$stmt->bind_param("si", $status, $sid);
						if ($stmt->execute()) {
							echo json_encode(['status' => '0']);
							if($status == '0')
								{
									$_SESSION['msg'] = "Inactive Id successfully";
								}
								else{
									$_SESSION['msg'] = "Do Not Inactive Id ";
								}
						} else {
							echo json_encode(['status' => false, 'error' => $stmt->error]);
							$_SESSION['msg_error'] = "Error";
						}
					}
				}
				catch (Exception $e) {
					echo json_encode(['status' => false, 'message' => 'An error occurred']);
					logMessage("Exception caught: " . $e->getMessage(), 'error');
					logMessage("Line: " . $e->getLine(), 'error');
				}

			}
			
			// Add  billing Address
			
			if ($action == "billing_address") {
				
				try{
					// Get data from AJAX request
					$first_name_c = test_input($_POST['first_name']);
					$first_name = ucfirst($first_name_c);
					
					$last_name_c = test_input($_POST['last_name']);
					$last_name = ucfirst($last_name_c);
					
					$email_c = test_input($_POST['email']);
					$email = ucfirst($email_c);
					
					$phone_c = test_input($_POST['phone']);
					$phone = ucfirst($phone_c);
					
					$address_line_1_c = test_input($_POST['address_line_1']);
					$address_line_1 = ucfirst($address_line_1_c);
					
					$address_line_2_c = test_input($_POST['address_line_2']);
					$address_line_2 = ucfirst($address_line_2_c);

					$country_c = test_input($_POST['country']);
					$country = ucfirst($country_c);
					
					$city_c = test_input($_POST['city']);
					$city = ucfirst($city_c);
					
					$state_c = test_input($_POST['state']);
					$state = ucfirst($state_c);
					
					$pin_code_c = test_input($_POST['pin_code']);
					$pin_code = ucfirst($pin_code_c);
					
					
					// Insert data into the category table

					$sql = "INSERT INTO billingaddress (first_name,last_name,email,phone,address_line_1,address_line_2,country,city,state,pin_code) VALUES ('$first_name','$last_name','$email','$phone','$address_line_1','$address_line_2','$country','$city','$state','$pin_code')";
					
					if ($conn->query($sql) === TRUE) {
						echo json_encode(['status' => true]);
						$_SESSION['msg'] = "Add billing_Address successfully";
						logMessage("successfully Insert Billing Address ".$first_name." ".$last_name." Pin Code = ".$pin_code);
					} else {
						echo json_encode(['status' => false]);
						$_SESSION['msg_error'] = "Do Not Add billing_Address ";
						logMessage("Failed Do Not Insert Billing Address ".$first_name." ".$last_name." Pin Code = ".$pin_code);
					}
				}
				catch (Exception $e) {
					echo json_encode(['status' => false, 'message' => 'An error occurred']);
					logMessage("Exception caught: " . $e->getMessage(), 'error');
					logMessage("Line: " . $e->getLine(), 'error');
				}
			}
				
				
				// Update Socail Media 
				
				if ($action == "social_media_update") {
					
					try{
						// Get data from AJAX request
						$website_name_c = test_input($_POST['website_name']);
						$website_name = ucfirst($website_name_c);
						
						$email_c = test_input($_POST['email']);
						$email = ucfirst($email_c);
						
						$location_c = test_input($_POST['location']);
						$location = ucfirst($location_c);
						
						$phone_c = test_input($_POST['phone']);
						$phone = ucfirst($phone_c);
						
						$twitter_link_c = test_input($_POST['twitter_link']);
						$twitter_link = ucfirst($twitter_link_c);
						
						$facebook_link_c = test_input($_POST['facebook_link']);
						$facebook_link = ucfirst($facebook_link_c);
						
						$linkedin_link_c = test_input($_POST['linkedin_link']);
						$linkedin_link = ucfirst($linkedin_link_c);
						
						$instagram_link_c = test_input($_POST['instagram_link']);
						$instagram_link = ucfirst($instagram_link_c);
						
						$google_map_link_c = test_input($_POST['google_map_link']);
						$google_map_link = ucfirst($google_map_link_c);
						
					
						
					
						// Insert data into the category table

						$sql = "UPDATE site_settings SET website_name='$website_name',email='$email', location='$location',phone='$phone',twitter_link='$twitter_link',facebook_link='$facebook_link', linkedin_link='$linkedin_link',instagram_link='$instagram_link',google_map_link='$google_map_link'";
						
						if ($conn->query($sql) === TRUE) {
							echo json_encode(['status' => true]);
							$_SESSION['msg'] = "successfully Update social Media Data";
							logMessage("successfully Update social Media Link ".$website_name." Email = ".$email);
						} else {
							echo json_encode(['status' => false]);
							$_SESSION['msg_error'] = "failed Update social Media Data";	
							logMessage("Failed Do Not Update social Media Link ".$website_name." Email = ".$email);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

					
				}
				
				
				// Add address 
				
				if ($action == "add_address") {
					
					try{
						// Get data from AJAX request
						
						$customer_id = $_SESSION['customer_id'];
						
						$country_c = test_input($_POST['country']);
						$country = ucfirst($country_c);
						
						$fullname_c = test_input($_POST['fullname']);
						$fullname = ucfirst($fullname_c);
						
						$phone_c = test_input($_POST['phone']);
						$phone = ucfirst($phone_c);
						
						$pincode_c = test_input($_POST['pincode']);
						$pincode = ucfirst($pincode_c);
						
						$house_c = test_input($_POST['house']);
						$house = ucfirst($house_c);
						
						
						$street_c = test_input($_POST['street']);
						$street = ucfirst($street_c);
						
						$landmark_c = test_input($_POST['landmark']);
						$landmark = ucfirst($landmark_c);
						
						$twon_c = test_input($_POST['town']);
						$town = ucfirst($twon_c);
						
						
						$state_c = test_input($_POST['state']);
						$state = ucfirst($state_c);
						
						$delivery_c = test_input($_POST['delivery']);
						$delivery = ucfirst($delivery_c);
					
						
						// Insert data into the category table

						$sql = "INSERT INTO customer_address (customer_id,country,full_name,phone,pincode,house_no,street,landmark,town,state,delivery_instructions	) VALUES ('$customer_id','$country','$fullname','$phone','$pincode','$house','$street','$landmark','$town','$state','$delivery')";

						if ($conn->query($sql) === TRUE) {
							echo json_encode(['status' => true]);
							$_SESSION['msg'] = "Successfully Add Address";
							logMessage("successfully Shipping Address Country ".$country." Customer Id = ".$customer_id);
							

						} else {
							echo json_encode(['status' => false]);
							$_SESSION['msg_error'] = "Do Not Add Categories ";
							logMessage("Failed Do NotInsert Shipping Address ".$country." Customer Id = ".$customer_id);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

						
				}
				
				
				// place_order_list
				if ($action == "add_to_cart") {
					
					try{
					
						// Get data from AJAX request
						$customer_id = $_SESSION['customer_id'];
						
						$product_id_c = test_input($_POST['product_id']);
						$product_id = ucfirst($product_id_c);
						
						$total_price_c = test_input($_POST['total_price']);
						$total_price = ucfirst($total_price_c);
						
						$stock_c = test_input($_POST['stock']);
						$stock = ucfirst($stock_c);
						
						$qut_c = test_input($_POST['qut']);
						$qut = ucfirst($qut_c);
						
					
						if($qut > 0 )
						{
							$sql = "SELECT * FROM product WHERE product_id ='$product_id'";
							
							$row  = $conn->query($sql);
							$result = $row->fetch_assoc();
							$product_name = $result['product_name'];
							$product_id_1 = $result['product_id'];
							$product_price = $result['price'];
							$description = $result['description'];
							$product_color = $result['product_color'];
							$product_size = $result['product_size'];
							if (mysqli_query($conn, $sql)) {
								
									$sql_cart_id = "SELECT * FROM add_to_cart WHERE product_id ='$product_id' AND customer_id='$customer_id'";
									$row_cart  = $conn->query($sql_cart_id);
									$result_cart = $row_cart->fetch_assoc();
									$product_id_cart = $result_cart['product_id'];
								if($product_id_cart == $product_id)
								{
										
									$sql = "UPDATE add_to_cart SET cart_qty='$qut' WHERE customer_id = '$customer_id' AND product_id = '$product_id'";


									if ($conn->query($sql) === TRUE) {
										echo json_encode(['status' => true]);
										$_SESSION['msg'] = "Successfully Update Quantity";
										logMessage("successfully Update Quantity Product Id ".$product_id." Customer Id = ".$customer_id);
									} else {
										echo json_encode(['status' => true]);
										$_SESSION['msg'] = "Not Update Data";
										logMessage("successfully Update Quantity Product Id ".$product_id." Customer Id = ".$customer_id);
									}
								}
								else{
										$cart_insert = "INSERT INTO add_to_cart(product_id, customer_id,cart_name,cart_qty,cart_price,description,cart_color,cart_size,total_price,stock) VALUES('$product_id','$customer_id','$product_name','$qut','$product_price','$description','$product_color','$product_size','$total_price','$stock')";
										if($conn->query($cart_insert) === TRUE )
										{
											echo json_encode(['status' => true]);
											$_SESSION['msg'] = "Successfully Add Quantity";
											logMessage("successfully Add Quantity Product Id ".$product_id." Customer Id = ".$customer_id);
											
										}
										else{
											echo json_encode(['status' => false]);
											$_SESSION['msg'] = "Not Insert Data";
											logMessage("Failed Do Not add Quantity Product Id ".$product_id." Customer Id = ".$customer_id);
										}
									}
									
							} else {
								echo json_encode(['status' => false]);
								$_SESSION['msg_error'] = "Do Not Metch Product Id ";
								logMessage("Failed Do Not Match Product Id");
							}
							
						}
						else {
							echo json_encode(['status' => false]);
							$_SESSION['msg_error'] = "Please Add Quantity";
							logMessage("Failed Check Quantity");
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

				}
				
				
				// Delete Add To Cart
				
				if ($action == "add_to_cart_delete") {
					try{
						$cart_id = test_input($_POST['cart_id']);
						// Perform the deletion query (Example, please use prepared statements for security)
						$sql = "DELETE FROM add_to_cart WHERE cart_id='$cart_id'";

						if (mysqli_query($conn,$sql)) {
							echo json_encode(['status' => true]);
								$_SESSION['msg'] = "Delete Add To cart Successfully";
								logMessage("Successful Add To cart Delete Cart Id = ".$cart_id);
						} else {
							echo json_encode(['status' => false]);
								$_SESSION['msg_error'] = "Failed Do not Delete Add To Cart";
								logMessage("Failed Do not Delete Add To Cart Id = ".$cart_id);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

				}
				
				// Update Add To Cart
				
				if ($action == "update_add_to_cart") {
					
					try{
							// Get data from AJAX request and sanitize
						$customer_id = $_SESSION['customer_id'];
						$qut = test_input($_POST['qut']);
						$total_price = test_input($_POST['total_price']);
						$product_id = test_input($_POST['product_id']);
						
						// Use prepared statement to prevent SQL injection
						$sql = "UPDATE add_to_cart SET cart_qty=?, total_price=? WHERE product_id=? AND customer_id=?";
						
						// Prepare and execute the statement
						$stmt = $conn->prepare($sql);
						$stmt->bind_param("sss", $qut, $total_price, $product_id,$customer_id);
						
						if ($stmt->execute()) {
							echo json_encode(['status' => true]);
							$_SESSION['msg'] = "Update Add To Cart successfully Quantity" ;
							logMessage("Successful Update Add To cart ".$qut." Total Price ".$total_price." Product Id ".$product_id." Customer Id = ".$customer_id);
						} else {
							echo json_encode(['status' => false]);
							$_SESSION['msg_error'] = "Failed to Update Add To Cart";
							logMessage("Failed Do Not Update Add To cart ".$qut." Total Price ".$total_price." Product Id ".$product_id." Customer Id = ".$customer_id);
						}
					}
					catch (Exception $e) {
						echo json_encode(['status' => false, 'message' => 'An error occurred']);	
						logMessage("Exception caught: " . $e->getMessage(), 'error');
						logMessage("Line: " . $e->getLine(), 'error');
					}

				}
				
		}	
		
		mysqli_close($conn);
?>
