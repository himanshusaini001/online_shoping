<?php 
	include('../include/db_file/config.php');
	include('../include/db_file/connection_file.php');
	$nameErr = $passwordErr = "";
	if(isset($_POST['submit']))
	{
		function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		
		} $sql = "select * from admin";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$name =  $row['name'];
		
		
			$username = $_POST["username"];
			if($username == $name)
			{
				header("location:category/showcategory.php");
				$_SESSION['username'] = $name;
			}
	}
		  
	
	
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admin login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href="<?php  echo DTS_WS_SITE_CSS ?>bg_style.css" rel="stylesheet" type="text/css"media="screen">
	<style>
	body{
		margin:0px;
		padding:0px;
			
		}
		.top_bg {
			background-image: url(../assets/img/login-background2.jpg);
			background-position: top cente;
			background-size: cover;
			padding: 0px;
			width: 100%;
			background-repeat: no-repeat;
		}
			.form_bg{
			background: #fff;
		}

		
	element.style {
	}
	.black_bg {
		background: #000;
		width: 100%;
		height: 100%;
		opacity: 0.6;
	}
	.error {color: #FF0000;}

	</style>
  </head>
  <body >
  
  <div class="container-fluid top_bg">
	<div class="black_bg">
		<div class="   ">
			<div class="row p-5">
				<div class="col-lg-5 p-5 my-5 form_bg shadow-lg border" style="border-radius:10px">
				<h1>login</h1>
				 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="form">
			
                    <div class="mb-3">
                        <label for="username" class="form-label">user name</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp"
                            placeholder="Enter user name">
						<span class="error">* <?php echo $nameErr;?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter the password">
						<span class="error">* <?php echo $passwordErr;?></span>
                    </div>
             
                    <button type="submit"  class="btn btn-primary" name="submit">submit</button>
                </form>
				</div>
			</div>
		</div>	
	</div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>