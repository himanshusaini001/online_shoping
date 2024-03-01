<?php 
	include('../../include/db_file/config.php');
	include('../../include/db_file/connection_file.php');
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
				<div class="col-12 mt-5 bg_white">
					<div>
						<a href="addcategory.php" class="btn btn-primary">Add Category</a>
					</div>
					<?php
						
						$sql ="SELECT * FROM category";
						
						$result = $conn->query($sql);
						if($result->num_rows > 0)
						{
						?>
							
							<table class="table  table-bordered mt-3">
								<tr>
									<th>SH:</th>
									<th>Category name</th>
									<th>Category img</th>
									<th>UPDATE</th>
									<th>DELETE</th>
									<th>VIEW</th>
								</tr>
								
								<?php
								$sr = 1;
									while($row = $result->fetch_assoc())
									{
								?>
								<tr class="table-secondary">
									<td><?php echo $sr ?></td>
									<td><?php echo $row['cname'] ?></td>
									<td><?php echo $row['cimg'] ?></td>
									<td><a href="update_category.php?cid=<?php echo  $row['cid'] ?>" class="btn btn-warning">UPDATE</a></td>
									<td><a href="delete_category.php?cid=<?php echo  $row['cid'] ?>" class="btn btn-danger">DELETE</a></td>
									<td><a href="view_category_p.php?cid=<?php echo  $row['cid'] ?>" class="btn btn-success">VIEW</a></td>
								</tr>
								<?php 
								$sr++;
	
									}
								?>
							</table>
						<?php
						}

						?>	

				</div>
			</div>
		</div>
	</div>	
	
</body>
</html>