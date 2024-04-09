<?php 
	// Admin Log Out 
	include('../include/db_file/config.php');
	
	if(!isset($_SESSION['admin_name']))
	{
			header("location:index.php");
	}
	
	session_unset();
	session_destroy();
	
	header("location:index.php");
?>