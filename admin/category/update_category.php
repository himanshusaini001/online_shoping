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
$cid = $_GET['cid'];
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
            <h1 class="m-0">Update Categories </h1>
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
					$sql = "SELECT * FROM category WHERE cid=$cid";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
						while($row = $result->fetch_assoc())
						{
							
					?>
					   <form class="custom-form shadow p-4" id="addForm" action="#" method="post" enctype="multipart/form-data">
							<!-- Name Field -->
							<input type="hidden" class="form-control" name="action" value="update_category" required>
							<div class="form-group">
								<label for="cname">Name:</label>
								<input type="text" class="form-control" id="cname" name="cname" value="<?php echo $row['cname'] ?>" placeholder="Enter name" required>
								<input type="hidden" class="form-control" id="cid" name="cid" value="<?php echo $cid ?>" placeholder="Enter name" required>
							</div>

							<!-- Image Field -->
							<div class="form-group">
								<label for="img">Image URL:</label>
								<input type="file" class="form-control" id="cimg" name="cimg" value="<?php echo $row['cimg'] ?>" placeholder="Enter image URL" required><img src="../../admin/assets/upload_img/<?php echo $row['cimg'] ?>" width="50px" height="50px" >
							</div>
							
							<!-- Status Field -->
							<div class="form-group">
								<label for="selectOption" >Status</label>
								<select type="text" class="form-control"  id="status" name="status" placeholder="Enter status URL"  required>
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
   
 <!-- Start Footer tag -->
	<?php 
		include("../include/main_file/footer.php");
	?>
 <!-- End Footer tag -->
</div>
<!-- ./wrapper -->

<!-- Start Script Tag -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <script>
        $(document).ready(function () {
            // Form validation using jQuery
            $("#submitBtn").click(function () {
                // Reset previous error messages
				try{
					$(".error-message").text("");
					var cid = $("#cid").val();
					var cname = $("#cname").val();
					var cimg = $("#cimg").val();
					var status = $("#status").val();
					var isValid = true;

					if (cname === "") {
						isValid = false;
					}
					
					if (status === "") {
						isValid = false;
					}

					if (!isValid) {
						alert("Name and Image URL are required.");
					} else {
						// AJAX to submit form data
						var form = document.getElementById('addForm');
						let formdata = new FormData(form);
						$.ajax({
							type: "POST",
							url: "../../functions/function_ajax.php", // Replace with the actual server-side processing script
							data: formdata,
							processData: false,
							contentType: false,
							success: function (response) {
								var resp = JSON.parse(response);
								if (resp.status) {
									// Redirect to another page after successful insertion
									window.location.href = "../category/show_category.php";
								} else {
									alert("Error: " + response);
								}
							},
							error: function (xhr, status, error) {
								alert("AJAX request failed: " + status + "\nError: " + error);
							}
						});
					}
				}
				catch(error){
					alert("An error occurred at line " + error.line + ": " + error.message);
				}
                
            });
        });
    </script>
	<!-- End Script Tag -->
</body>
</html>
