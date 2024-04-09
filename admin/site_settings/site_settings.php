<?php

// Start Include File 

// Start Config File 
	require_once('../include/db_file/config.php');
// End Config File 

// Start Connection File 
	require_once("../include/db_file/connection_file.php");
// End Connection File 

// Start Session 
	if(!isset($_SESSION['admin_name']))
	{
		header("location:../index.php");
	}
// End Session

// Start Top Link File 
	include("../include/main_file/top_link.php");
// End Top Link File 

// Start Top Link File 
	include("../include/main_file/main_sidebar.php");
// End Top Link File 
?>
<!-- Start Body Tag -->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains Page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header border_bottom_header">
        <div class="container-fluid">
            <div class="row mb-2">
			<div class="col-sm-4">
			   <ul class="navbar-nav">
				  <li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				  </li>
				  <!--li class="nav-item d-none d-sm-inline-block">
					<a href="../category/show_category.php" class="nav-link">Home</a>
				  </li-->
				</ul>
			</div>
                <div class="col-sm-4">
                    <h1 class="m-0">Update Site Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><span><a href="../../admin/admin_logout.php" class="btn btn-primary">Logout</a></span></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
        <div>
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10" >
				<?php 
				include("../include/main_file/flash_message.php");
				$sql1 = "SELECT * FROM site_settings";
					$result1 = $conn->query($sql1);
					if($result1->num_rows > 0)
					{
						while($row1 = $result1->fetch_assoc())
						{
						
					?>
					
                    <form  id="addForm" action="" method="post" enctype="multipart/form-data" width="100%" style="height: 400px; overflow: auto;" >
						<input type="hidden" class="form-control" name="action" value="update_product" required>
							<!-- Name Field -->
						<input type="hidden" class="form-control"  name="action" value="social_media_update" placeholder="Enter image URL" required>
						<h3>Website Settings</h3>
						<div class="custom-form shadow p-4 row">
							<div class=" col-md-6">
							<div class="form-group">
									<label for="cname">Website Name:</label>
									<input type="text" class="form-control"  name="website_name" placeholder="Enter name" id="website_name" value="<?php echo $row1['website_name'] ?>" required>
								</div>
								<div class="form-group">
									<label for="cname">Email:</label>
									<input type="email" class="form-control"  name="email" placeholder="Enter name" id="email" value="<?php echo $row1['email'] ?>" required>
								</div>
							</div>
							<div class=" col-md-6">
								<div class="form-group">
									<label for="cname">Location:</label>
									<input type="text" class="form-control"  name="location" placeholder="Enter name" id="location" value="<?php echo $row1['location'] ?>" required>
								</div>
								<div class="form-group">
									<label for="cname">Phone:</label>
									<input type="number" class="form-control"  name="phone" placeholder="Enter name" id="phone" value="<?php echo $row1['phone'] ?>" required>
								</div>
							</div>
						</div>
						<h3>Social Media Link</h3>
						<div class="custom-form shadow p-4 row">
							<div class=" col-md-6">
								<div class="form-group">
									<label for="cname">Tiwtter Link:</label>
									<input type="text" class="form-control"  name="twitter_link" placeholder="Enter name" id="twitter_link" value="<?php echo $row1['twitter_link'] ?>" required>
								</div>
								<div class="form-group">
									<label for="cname">Facebook Link:</label>
									<input type="text" class="form-control"  name="facebook_link" placeholder="Enter name" id="facebook_link" value="<?php echo $row1['facebook_link'] ?>" required>
								</div>
								<div class="form-group">
									<label for="cname">Google Map Link:</label>
									<input type="text" class="form-control"  name="google_map_link" placeholder="Enter name" id="google_map_link" value="<?php echo $row1['google_map_link'] ?>" required>
								</div>
							</div>
							<div class=" col-md-6">
								<div class="form-group">
									<label for="cname">Linked In Link:</label>
									<input type="text" class="form-control"  name="linkedin_link" placeholder="Enter name" id="linkedin_link" value="<?php echo $row1['linkedin_link'] ?>" required>
								</div>
								<div class="form-group">
									<label for="cname">Instagram Link:</label>
									<input type="text" class="form-control"  name="instagram_link" placeholder="Enter name" id="instagram_link" value="<?php echo $row1['instagram_link'] ?>" required>
								</div>
							</div>
						</div>
						<div class=" col-md-12">
							<!-- Submit Button -->
							<input type="hidden" class="form-control" id="product_id" name="product_id" value="<?php echo $product_id ?>" placeholder="Enter name" required>
							<button type="button" style="float:right" class="btn btn-primary" id="submitBtn">Submit</button>
						</div>
						</form>
					
					
					<?php 
						}
					}
					?>
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

  <!-- Start Footer Tag -->
	<?php
		include("../include/main_file/footer.php");
	?>
  <!-- End Footer Tag -->
</div>
<!-- ./wrapper -->

<!-- Start Footer Tag -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Form validation using jQuery
        $("#submitBtn").click(function () {
			try{
				// Reset previous error messages
				$(".error-message").text("");
				
				var website_name = $("#website_name").val();
				var email = $("#email").val();
				var location = $("#location").val();
				var phone = $("#phone").val();
				var twitter_link = $("#twitter_link").val();
				var facebook_link = $("#facebook_link").val();
				var linkedin_link = $("#linkedin_link").val();
				var instagram_link = $("#instagram_link").val();
				
				if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
					alert("Check name field, add only characters." );
				}
				else{
					 var isValid = true;

				if (location === "") {
					isValid = false;
				}
				if (website_name === "") {
					isValid = false;
				}
				if (phone === "") {
					isValid = false;
				}
				if (twitter_link === "") {
					isValid = false;
				}
				if (facebook_link === "") {
					isValid = false;
				}
				if (linkedin_link === "") {
					isValid = false;
				}
				if (instagram_link === "") {
					isValid = false;
				}
				
				if (!isValid) {
					alert("All Fild are required.");
				} else {
					
					var form = document.getElementById('addForm');
					let formdata = new FormData(form);
					// AJAX to submit form data
					$.ajax({
						type: "POST",
						url: "../../functions/function_ajax.php", // Replace with the actual server-side processing script
						data: formdata,
						processData: false,
						contentType: false,
						success: function (response) {
							let resp = JSON.parse(response);
							if(resp.status)
							{
								window.location = "../../admin/site_settings/site_settings.php" ;
							}
							else{
								alert ("Failed Update Social Media Update");
							}
							
						},
						error: function (xhr, status, error) { 
							alert("AJAX request failed: " + status + "\nError: " + error);
						}
					});
				}
				}
			}catch (e) {
				alert("An error occurred at line " + e.line + ": " + e.message);
            }
        });
    });
</script>
<!-- End Footer Tag -->
</body>
<!-- End Body Tag -->
</html>
