<?php

include('../include/db_file/config.php');
include("../include/db_file/connection_file.php");

include("../include/main_file/top_link.php");
include("../include/main_file/main_sidebar.php");

	if(!isset($_SESSION['admin_name']))
	{
			header("location:../index.php");
	}
$cid = $_GET['cid'];
?>
  
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
            <h1 class="m-0">Update Category </h1>
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
							<div class="form-group">
								<label for="cname">Name:</label>
								<input type="text" class="form-control" id="cname" name="cname" value="<?php echo $row['cname'] ?>" placeholder="Enter name" required>
								<input type="hidden" class="form-control" id="cid" name="cid" value="<?php echo $cid ?>" placeholder="Enter name" required>
							</div>

							<!-- Image Field -->
							<div class="form-group">
								<label for="img">Image URL:</label>
								<input type="file" class="form-control" id="cimg" name="cimg" value="<?php echo $row['cimg'] ?>" placeholder="Enter image URL" required>
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
	<?php 

		include("../include/main_file/footer.php");

	?>
	<!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <script>
        $(document).ready(function () {
            // Form validation using jQuery
            $("#submitBtn").click(function () {
                // Reset previous error messages
                $(".error-message").text("");
				var cid = $("#cid").val();
                var cname = $("#cname").val();
                var cimg = $("#cimg").val();
				var status = $("#status").val();
                var isValid = true;

                if (cname === "") {
                    isValid = false;
                }

                if (cimg === "") {
                    isValid = false;
                }
				
				if (status === "") {
                    isValid = false;
                }

                if (!isValid) {
                    alert("Name and Image URL are required.");
                } else {
                    // AJAX to submit form data
                    $.ajax({
                        type: "POST",
                        url: "../../functions/function_ajax.php", // Replace with the actual server-side processing script
                        data: {
							action:"update_category",
                            cname: cname,
                            cimg: cimg,
							status: status,
							cid: cid
                        },
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
                }
            });
        });
    </script>
</body>
</html>
