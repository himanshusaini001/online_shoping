<?php 
	include('../../include/db_file/config.php');
	include('../../include/db_file/connection_file.php');
	$nameErr  = $imgErr =  "";
	
	if(isset($_POST['submit']))
	{
		
		if(empty($_POST["cname"])) {
			$nameErr = "name is not required";
		  } else {
			$cname = $_POST["cname"];
		  }
		if(empty($_FILES["cimg"]['name'])) {
			$imgErr = "img is not  required";
		  } else {
			$cimg = $_FILES["cimg"]['name'];
			  $target_dir = "../../upload_img/";
			  $target_file = $target_dir . basename($_FILES["cimg"]['name']);
			  move_uploaded_file($_FILES["cimg"]["tmp_name"],$target_file);
				
		  }

		if($_POST['cname']!='' && $_FILES['cimg']!='' )
		{
			$sql ="INSERT INTO category(cname,cimg)VALUE('$cname','$cimg')";
			if ($conn->query($sql)) {
				header("location:showcategory.php");
			} 
			else
			{
				echo "Do not insert data";
			}
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
	
    <link href="<?php echo DTS_WS_SITE_ASSETS ?>bg_style.css" rel="stylesheet" type="text/css"media="screen">
	<title>Document</title>
	<title>Document</title>
</head>
<body>	

	<div class="container-fluid ">
		<div class="container">
			<div class="row">
				<div class="col-3">
				</div>
				<div class="col-6 mt-5  add_form_bg">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"  enctype="multipart/form-data">
						<h1 class="mb-4">Add Category</h1>
						<div class="form-group mb-3">
							<label for="exampleInputEmail1" class="mb-2">Category name</label>
							<input type="text" name="cname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category name">
							<span class="error">* <?php echo $nameErr;?></span>
						</div>
						<div class="form-group mb-3">
							<label for="exampleInputEmail1" class="mb-2">Category IMG</label>
							<input type="file" name="cimg" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category name">
							<span class="error">* <?php echo $imgErr;?></span>
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
				<div class="col-3">
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