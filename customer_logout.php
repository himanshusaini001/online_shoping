<?php
	// Include configuration file
	require_once('include/db_file/config.php');

	// Check if the user is not logged in
	if(!isset($_SESSION['customer_login'])) {
		// Redirect to the customer login page
		header("location: customer_login.php");
	}

	// Unset all session variables
	session_unset();

	// Destroy the session
	session_destroy();

	// Redirect to the index.php page after logout
	header("location:index.php");
?>
