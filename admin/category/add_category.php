<?php
// Start Include file

//  Config file Start

	require_once('../include/db_file/config.php');
	
//  Config file End

//  Connection file Start

	require_once("../include/db_file/connection_file.php");
	
//  Connection file End

//  Session Start
	if(!isset($_SESSION['admin_name']))
	{
		header("location:../index.php");
	}
	
//  Session End

//  Top Link file Start

	include("../include/main_file/top_link.php");

//  Top Link file End

//  Main_sidebar file Start

include("../include/main_file/main_sidebar.php");

//  Main_sidebar file Start

// End Include file
?>

<!-- Start Body Tag  -->
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
						<h1 class="m-0">Add Categories Page</h1>
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
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
						<form class="custom-form shadow p-4" id="addForm" action="" method="post" enctype="multipart/form-data">
						<!-- Name Field -->
							<input type="hidden" class="form-control" name="action" value="category" required>
							<div class="form-group">
								<label for="cname">Name:</label>
								<input type="text" class="form-control" id="cname" name="cname" placeholder="Enter name" required>
							</div>
						<!-- Image Field -->
							<div class="form-group">
								<label for="img">Image URL:</label>
								<input type="file" class="form-control" id="cimg" name="cimg" accept=".jpg, .jpeg, .png"  placeholder="Enter image URL"  required>
							</div>
						<!-- Status Field -->
							<div class="form-group">
								<label for="selectOption" >Select an option:</label>
								<select type="text" class="form-control"  id="status" name="status" placeholder="Enter status URL"  required>
									<option value="0">Inactive</option>
									<option value="1">Active</option>
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
			<!-- /.content -->
		</div>

		<!-- Start Footer Tag  -->

		<?php 
		include("../include/main_file/footer.php");
		?>

		<!-- End Footer Tag  -->	

		<!-- End Script Tag  --> 
	</div>


<!-- Start Script Tag  -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
    // Form validation using jQuery
    $("#submitBtn").click(function () {
        // Reset previous error messages
        $(".error-message").remove();

        // Validation and trimming for the name field
        var cname = $.trim($("#cname").val());
        if (cname === "" || !/^[a-zA-Z ]+$/.test(cname)) {
            $("#cname").after('<span class="error-message">Please enter a valid name (only letters and spaces).</span>');
            return;
        }

        // Validation for the image field
        var cimg = $("#cimg").val();
        if (!cimg) {
            $("#cimg").after('<span class="error-message">Please select an image.</span>');
            return;
        }

        // Validation for the status field
        var status = $("#status").val();
        if (!/^[0-1]$/.test(status)) {
            $("#status").after('<span class="error-message">Please select a valid status.</span>');
            return;
        }

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
                if (response === "success") {
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
    });
});
</script>

<!-- End Script Tag  -->

</body>

<!-- End Body Tag  -->

</html>
