<?php	
	// Assuming you have a database connection already established
	
		include('../include/db_file/config.php');
		include('../include/db_file/connection_file.php');
		
		// Session Start
		
		// Session End
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$action = $_POST["action"];
			
			// Insert Query All Start ->
			
			
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
			
			
			// Add category 
				
			if ($action == "category") {
				// Get data from AJAX request
				$cname = $_POST['cname'];
				$cimg = $_POST['cimg'];
				$status = $_POST['status'];
				// Insert data into the category table

				$sql = "INSERT INTO category (cname, cimg ,status) VALUES ('$cname', '$cimg', '$status')";

				if ($conn->query($sql) === TRUE) {
					echo "success";
				} else {
					echo "Error: " . $conn->error;
				}
			}
			
			//Add Size 
			
			if ($action == "add_size") {
				// Get data from AJAX request
				$size = $_POST['size'];
				$status = $_POST['status'];

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
				$color = $_POST['color'];
				$status = $_POST['status'];
				

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
				
				
				// Update Category
				
				if ($action == "update_category") {
					// Get data from AJAX request
					$cname = $_POST['cname'];
					$cimg = $_POST['cimg'];
					$cid = $_POST['cid'];
					$status = $_POST['status'];
					// Insert data into the category table

					$sql = "UPDATE category SET cname='$cname',cimg='$cimg',status='$status' where cid='$cid'";

					if ($conn->query($sql) === TRUE) {
						echo "success";
					} else {
						echo "Error: " . $conn->error;
					}
				}
				
				
				// Update size
				
				if ($action == "update_size") {
					// Get data from AJAX request
					$size = $_POST['size'];
					$sid = $_POST['sid'];
					$status = $_POST['status'];
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
					$color_name = $_POST['color_name'];
					$color_id = $_POST['color_id'];
					$status = $_POST['status'];
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
			
			
			// Delete Category
				
				if ($action == "delete_category") {
					 $cid = $_POST['cid'];

					// Perform the deletion query (Example, please use prepared statements for security)
					$sql = "DELETE FROM category WHERE cid = $cid";

					if (mysqli_query($conn, $sql)) {
						echo "Record deleted successfully";
					} else {
						echo "Error deleting record: " . mysqli_error($conn);
					}
				}
				
				// Delete size
				
				if ($action == "delete_size") {
					 $sid = $_POST['sid'];

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
					 $color_id = $_POST['color_id'];

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
			
					 if ($action == "random_link") 
					 {
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
				
				
				
				
		}
		
		mysqli_close($conn);
?>
