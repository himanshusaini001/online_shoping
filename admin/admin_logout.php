<?php 
	include('../include/db_file/config.php');
	
	if(!isset($_SESSION['admin_name']))
	{
			header("location:admin_login.php");
	}
	
	session_unset();
	session_destroy();
	
	header("location:admin_login.php");
?>