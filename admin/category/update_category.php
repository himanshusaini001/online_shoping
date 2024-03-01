<?php 
	include('../../include/db_file/config.php');
	include('../../include/db_file/connection_file.php');
	if(isset($_POST['submit']))
		{
			$cid = $_POST['cid'];
			$cname = $_POST['cname'];
			if(isset($_FILES['cimg']['name']) &&  $_FILES['cimg']['name']!='' )
			{
				$target_dir = "../../upload_img/";
				$target_file = $target_dir . basename($_FILES['cimg']['name']);
				move_uploaded_file($_FILES['cimg']['tmp_name'],$target_file);
				$cimg = $_FILES['cimg']['name'];
			}
			else
			{
				$sql ="select * from category where cid =$cid";
				$res = $conn->query($sql);
				$cdata = $res->fetch_assoc();
				$cimg = $cdata['cimg'];
			}
			$sql ="UPDATE category SET cname='$cname',cimg='$cimg' WHERE cid=$cid";
			if($conn->query($sql))
			{
				header("location:showcategory.php");
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- meta tage -->
     <meta charset="UTF-8">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="John Doe">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Link  Bootstrap Stylesheet -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<!-- Customized Bootstrap Stylesheet -->
	
    <link href="<?php  echo DTS_WS_SITE_CSS ?>bg_style.css" rel="stylesheet" type="text/css"media="screen">
	
	<title>Document</title>
</head>
<body>	
	<div class="container-fluid ">
		<div class="container">
			<div class="row">
				<div class="col-6">
				</div>
				<div class="col-6 mt-5 bg_white">
				<?php 
					$cid = $_GET['cid'];
					$sql1 ="SELECT * FROM category where cid =".$cid;
						
						$result = $conn->query($sql1);
						if($result->num_rows > 0)
						{
							while($row = $result->fetch_assoc())
							{
				?>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label for="exampleInputEmail1" class="mb-2">Category name</label>
							<input type="text" name="cname" class="form-control" value="<?php echo $row['cname'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category name" >
						</div>
						<div class="form-group mb-3">
							<label for="exampleInputEmail1" class="mb-2">Category img</label>
							<input type="file" name="cimg" class="form-control" value="<?php echo $row['cimg'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category name" ><img src="<?php echo "../../upload_img/".$row['cimg'];?>" width="80px" height="80px">
						</div>
						<input type="hidden" name="cid" class="form-control" value="<?php echo $row['cid'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category name" >
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
					<?php

							}
						}
					?>
				</div>
			</div>
		</div>
	</div>	
	<!-- Footer -->
	<footer class="bg-primary text-center text-white fixed-bottom">
		<!-- Footer -->
		<div class="text-center p-3" style="background-color:#9f9e9b !important">
			© 2020 Copyright:
			<a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
		</div>
		<!-- Footer -->
	</footer>
	<!-- Footer -->

	
</body>
</html>