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
	$sid = $_GET['sid'];
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

 <!-- Content Wrapper. Contains page content -->
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
            <h1 class="m-0">Update Size Page</h1>
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
        <div >
           <div class="row">
			   <div class="col-md-3">
			   </div>
				<div class="col-md-6">
				<?php 
					$sql = "SELECT * FROM clothing_sizes WHERE sid=$sid";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
						while($row = $result->fetch_assoc())
						{
							
					?>
					   <form class="custom-form shadow p-4" id="addForm" action="#" method="post" enctype="multipart/form-data">
							<!-- Name Field -->
							<div class="form-group">
								<label for="cname">Name:</label>
								<input type="text" class="form-control" id="size" name="size" value="<?php echo $row['size'] ?>" placeholder="Enter name" required>
								<input type="hidden" class="form-control" id="sid" name="sid" value="<?php echo $sid ?>" placeholder="Enter name" required>
							</div>
							
							<!-- Status Field -->
							<div class="form-group">
								<label for="selectOption" >Status</label>
								<select type="text" class="form-control"  id="status" name="status" value="<?php echo $row['status'] ?>" placeholder="Enter status URL"  required>
									<option value="0">Inactive</option>
									<option value="1">Active</option>
								<!-- Add more options as needed -->
								</select>
							</div>
							<!-- Submit Button -->
							<button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
						</form>
						<?php 
						}
					}
					?>
				</div>
				<div class="col-md-3">
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
</div>
<!-- Start Footer Tag -->
<!-- ./wrapper -->

<!-- Start Script Tag -->
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
				
				var sid = $("#sid").val();
				var status = $("#status").val();
				var uppercaseText = $("#size").val();
				var size = uppercaseText.toUpperCase();

				if (size === "XS" || size === "S" || size === "M" || size === "L" || size === "XL" || size === "XXL" || size === "XXXL") {
					var isValid = true;

					if (size === "") {
						isValid = false;
						alert("Size is required.");
					}
					
					if (status === "") {
						isValid = false;
						alert("Size is required.");
					}

					if (isValid) {
						// AJAX to submit form data
						$.ajax({
							type: "POST",
							url: "../../functions/function_ajax.php", // Replace with the actual server-side processing script
							data: {
								action: "update_size",
								size: size,
								status: status,
								sid: sid
							},
							success: function (response) {
								var resp = JSON.parse(response);
								if (resp.status) {
									// Redirect to another page after successful insertion
									window.location.href = "../size/show_size.php";
								} else {
									alert("Size is Already Added");
								}
							},
							error: function (xhr, status, error) {
								alert("AJAX request failed: " + status + "\nError: " + error);
							}
						});
					}
				} else {
					let sizesList = ["XS", "S", "M", "L", "XL", "XXL", "XXXL"];
					sizesList.push(size);
					alert("Added size to the list: " + sizesList.join(', '));
					// Your code for the false condition goes here
				}
			}
			catch (e) {
				alert("An error occurred at line " + e.line + ": " + e.message);
            }
        });
    });
</script>
<!-- End Script Tag -->
</body>
</html>
