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

			if ($action == "register") {
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

			
			//Add Size 
			
			if ($action == "add_size") {
				// Get data from AJAX request
				$size = test_input($_POST['size']);
				$status = test_input($_POST['status']);
				// Insert data into the category table

				$sql = "INSERT INTO clothing_sizes (size,status) VALUES ('$size','$status')";

				if ($conn->query($sql) === TRUE) {
					echo "success";
				} else {
					echo "Error: " . $conn->error;
				}
			}
			
			//Add Color 
				
			if ($action == "add_color") {
				// Get data from AJAX request
				$color_c= test_input($_POST['color']);
				$color = ucfirst($color_c);
				$status = test_input($_POST['status']);
				

				// Insert data into the category table

				$sql = "INSERT INTO colors (color_name,status) VALUES ('$color','$status')";

				if ($conn->query($sql) === TRUE) {
					echo "success";
				} else {
					echo "Error: " . $conn->error;
				}
			}
			
			
			// Insert Query All End ->
			
			
			
			
			// Update Query All Start ->
			
			
				if ($action == "confrom_pass") {
					// Check if the OTP is provided
					$password = test_input(md5($_POST['password']));
					

					// Update the user information in the database
					$sql = "UPDATE registration SET password='$password' WHERE sid='1'";

					if ($conn->query($sql) === TRUE) {
						echo "successfully";
					} else {
						echo "Error updating record: " . $conn->error;
					}
				}
				// Update size
				
				if ($action == "update_size") {
					// Get data from AJAX request
					$size = test_input($_POST['size']);
					$sid = test_input($_POST['sid']);
					$status = test_input($_POST['status']);
					// Insert data into the category table

					$sql = "UPDATE clothing_sizes SET size='$size',status='$status' where sid='$sid'";

					if ($conn->query($sql) === TRUE) {
						echo "success";
					} else {
						echo "Error: " . $conn->error;
					}
				}
				
				
				// Update Color
				
				if ($action == "update_color") {
					// Get data from AJAX request
					$color_name_c = test_input($_POST['color_name']);
					$color_name = ucfirst($color_name_c);
					
					$color_id = test_input($_POST['color_id']);
					$status = test_input($_POST['status']);
					// Insert data into the category table

					$sql = "UPDATE colors SET color_name='$color_name',status='$status' where color_id='$color_id'";
					
					if ($conn->query($sql) === TRUE) {
						echo "success";
					} else {
						echo "Error: " . $conn->error;
					}
				}
				
			
			// Update Query All End ->
			
			
			// Delete Query All Start ->
			
			
				// Delete size
				
				if ($action == "delete_size") {
					 $sid = test_input($_POST['sid']);

					// Perform the deletion query (Example, please use prepared statements for security)
					$sql = "DELETE FROM clothing_sizes WHERE sid = $sid";

					if (mysqli_query($conn, $sql)) {
						echo "Record deleted successfully";
					} else {
						echo "Error deleting record: " . mysqli_error($conn);
					}
				}
				
				
				// Delete color
				
				if ($action == "delete_color") {
					 $color_id = test_input($_POST['color_id']);

					// Perform the deletion query (Example, please use prepared statements for security)
					$sql = "DELETE FROM colors WHERE color_id = $color_id";

					if (mysqli_query($conn, $sql)) {
						echo "Record deleted successfully";
					} else {
						echo "Error deleting record: " . mysqli_error($conn);
					}
				}
				
				
			// Delete Query All End ->
			
			
			// Select Query All Start ->
			
				// Login  function
				
				  if ($action == 'login') {
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

					
					
					// verify_otp  function
			
					 if ($action == "verify_otp") {
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
							}
						}
						else{
							  'error';
						}
					}
					
					
					
					// verify_otp  function
			
					 if ($action == "random_link") 
					 {
						// Check if the OTP is provided
						$email = test_input($_POST["email"]);

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
							
							  $resetLink = "http://localhost/online-shoping/reset_password/conform_password.php?sid=$sid&email=$email&token=".uniqid();
								echo $resetLink;die();
							// Send the link to the user's email (use a proper mail library in production)
							mail($email, "Password Reset", "Click the link to reset your password: $resetLink");
							
							}
						 else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
					}
					// admin Login
				
					  if ($action == "admin_login") {
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
							
						} else {
							// Provide a generic error message
							header('Content-Type: application/json');
							echo json_encode(["status" => "error", "message" => "Error executing the query"]);
						}
					  }
					
			// Select Query All End ->
			
			
			// Fetch Query All Start ->
			
			
				// Fetch Category 
					
					if ($action == "fetch_data") {
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
			
				// Fetch Size 
					if ($action == "fetch_size") {
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
				
				// Fetch color 
					if ($action == "fetch_color") {
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
			
			// Fetch Query All End ->
				
				// Admin Data Category Start
				
				// Add category 
				
				if ($action == "category") {
					// Get data from AJAX request
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
						echo "success";
					} else {
						echo "Error: " . $conn->error;
					}
				}
				
				// Delete Category
				
				if ($action == "delete_category") {
					 $cid = test_input($_POST['cid']);
					// Perform the deletion query (Example, please use prepared statements for security)
					$sql = "DELETE FROM category WHERE cid = $cid";

					if (mysqli_query($conn, $sql)) {
						echo "Record deleted successfully";
					} else {
						echo "Error deleting record: " . mysqli_error($conn);
					}
				}
				
				// Update Category
				
				if ($action == "update_category") {
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
						echo "success";
					} else {
						echo "Error: " . $stmt->error;
					}

				}
			
			// Admin Data Category 
				
				
				
				// Admin Data Product Start
				
				// Add product 
				
				if ($action == "add_product") {
				// Get data from AJAX request
				$category_c = test_input($_POST['category']);
				$category = ucfirst($category_c);
				$product_color = test_input($_POST['product_color']);
				$product_size = test_input($_POST['product_size']);
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
				$sql = "INSERT INTO product (category, product_color, product_size, price, product_name, description, product_img, status) VALUES ('$category', '$product_color', '$product_size', '$price', '$product_name', '$description', '" . implode(',', $product_imgs) . "', '$status')";
				
				if ($conn->query($sql) === TRUE) {
					echo json_encode(["status"=>true]);
				} else {
					echo json_encode(["status"=>false]);
				}
			}

				
				// Update Product
				
				if ($action == "update_product") {
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
					} else {
						echo json_encode(["status"=>false]);
					}

				}
				
				
				// Delete product
				
				if ($action == "delete_product") {
					
					 $product_id = test_input($_POST['product_id']);
					// Perform the deletion query (Example, please use prepared statements for security)
					$sql = "DELETE FROM product WHERE product_id='$product_id'";

					if (mysqli_query($conn,$sql)) {
						echo "Record deleted successfully";
					} else {
						echo "Error deleting record: " . mysqli_error($conn);
					}
				}
				
			// Admin Data Product End
			
			
			// Customer contact
			
			if ($action == "contact") {
				
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
					} else {
						// If email sending fails, return an error message
						echo json_encode(['status' => false, 'message'=>'Error sending email']);
					}
				} else {
					// If insertion fails, return an error message
					echo json_encode(['status'=>false, 'message'=>'Error inserting into database']);
				}

				
			} 
			
			// Update Category
				
			if ($action == "update_user") {
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
							echo json_encode(['status' => true]);
						} else {
							echo json_encode(['status' => false, 'error' => $stmt->error]);
						}
								
					} else {
						echo "<script>alert('Failed to send email.')</script>";
					}
				}
				else{
					$sql = "UPDATE user SET status=? WHERE sid=?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("si", $status, $sid);
					if ($stmt->execute()) {
						echo json_encode(['status' => true]);
					} else {
						echo json_encode(['status' => false, 'error' => $stmt->error]);
					}
				}
		
			}
				
			// Delete product
			
			if ($action == "delete_user") {
				
				 $sid = test_input($_POST['sid']);
				 $email = test_input($_POST['email']);
				// Perform the deletion query (Example, please use prepared statements for security)
				$sql = "DELETE FROM user WHERE sid='$sid'";

				if (mysqli_query($conn,$sql)) {
					echo "Record deleted successfully";
					
					$to = $email;
					$subject = "Your account is now active";
					$message = "Dear user,\n\nYour account is now active. Thank you for joining us!";
					$headers = "From: himanshusaini26112002@gmail.com";

					// Send the email
					if (mail($to, $subject, $message, $headers)) {
						echo "<script>alert('Sand Mail Successful')</script>";
					} else {
						echo "<script>alert('Failed to send email.')</script>";
					}
				} else {
					echo "Error deleting record: " . mysqli_error($conn);
				}
			}
		}
		
		mysqli_close($conn);
?>
