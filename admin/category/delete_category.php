<?php 
	include('../../include/db_file/config.php');
	include('../../include/db_file/connection_file.php');
	$cid = $_GET['cid'];
	
	$sql="DELETE FROM category where cid =".$cid;
	if($conn->query($sql))
	{
		header("location:showcategory.php");
	}
	else
	{
		echo  "Do not delete data";
	}

?>