<?php 
	include('../include/db_file/config.php');
	
	
	session_unset();
	session_destroy();
	
	header("location:index.php");
?>