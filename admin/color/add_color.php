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
            <h1 class="m-0">Add Color Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item active"><span><a href="../../admin/admin_logout.php" class="btn btn-primary">Logout</a></span></li>
			</ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.Container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
        <div >
           <div class="row">
			   <div class="col-md-3">
			   </div>
				<div class="col-md-6">
					   <form class="custom-form shadow p-4" id="addForm" action="#" method="post" enctype="multipart/form-data">
							<!-- XS Size Field -->
							<div class="form-group">
								<label for="cname">Color:</label>
								<input type="text" class="form-control" id="color" name="color" placeholder="Enter Size" required>
							</div>
							
							<!-- Status Field -->
							<div class="form-group">
								<label for="selectOption" >Select an option:</label>
								<select type="text" class="form-control"  id="status" name="status" placeholder="Enter status URL"  required>
								<option value="0">Inactive</option>
								<option value="1"> Active</option>
								<!-- Add more options as needed -->
								</select>
							</div>
							<!-- Submit Button -->
							<button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
						</form>
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
<!-- End Footer Tag -->
</div>
<!-- ./wrapper -->

<!-- Start Script -->
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
				var userInputColor = $("#color").val();
				var color = userInputColor.toLowerCase();
				var status = $("#status").val();
				
				var found = false;
				var colors = [
					'red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink',
					'brown', 'gray', 'black', 'white', 'cyan', 'magenta', 'turquoise',
					'gold', 'silver', 'indigo', 'maroon', 'olive', 'teal'
				];
				
				var isValid = true;
				if (color == "") {
					isValid = false;
					alert("Fild is required.");
				}
				
				if (status == "") {
					isValid = false;
					alert("Fild is required.");
				}

				for (var i = 0; i < colors.length; i++) {
					
					if (userInputColor == colors[i]) {
						
						found = true;

						if (isValid) {
							// AJAX to submit form data
							$.ajax({
								type: "POST",
								url: "../../functions/function_ajax.php", // Replace with the actual server-side processing script
								data: {
									action: "add_color",
									color: color,
									status: status
								},
								success: function (response) {
									var resp = JSON.parse(response);
									if (resp.status) {
										// Redirect to another page after successful insertion
										window.location.href = "../color/show_color.php";
									} else {
										alert("Color is Already Added");
									}
								},
								error: function (xhr, status, error) {
									alert("AJAX request failed: " + status + "\nError: " + error);
								}
							});
						}
					}
					
				}
				if (found == false) {
					alert("Please Chouse Color red, blue, green, yellow, orange, purple, pink,brown, gray, black, white, cyan, magenta, turquoise,gold, silver, indigo, maroon, olive, teal  ");
				} 
			}
			catch(e){
				alert("An error occurred at line " + e.line + ": " + e.message);
			}
        });
    });
</script>

<!-- Start Script -->
</body>
</html>
