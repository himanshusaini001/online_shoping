if ($action == "update_size") {
	// Get data from AJAX request
	$size = test_input($_POST['size']);
	$sid = test_input($_POST['sid']);
	$status = test_input($_POST['status']);
	// Insert data into the category table

	$sql = "UPDATE clothing_sizes SET size='$size',status='$status' where sid='$sid'";

	if ($conn->query($sql) === TRUE) {
		echo "ok";
	} else {
		echo "Not Ok";
	}
}