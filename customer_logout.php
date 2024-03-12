<?php
	require_once('include/db_file/config.php');
	
	if(!isset($_SESSION['customer_login']))
	{
		header("location: customer_login.php");
	}
	session_unset();
	session_destroy();
	
	header("location:index.php");
	
 ?>