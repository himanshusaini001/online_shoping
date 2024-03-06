<?php

    // Top Link Start 
	
	include("../../include/main_file/top_link.php");
	include("../../include/db_file/connection_file.php");
	 // Top Link Start
	
	// Sidebar Start 
	
		include("../../include/main_file/main_sidebar.php");
	
	// Sidebar End
	$color_id = $_GET['color_id'];
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
            <h1 class="m-0">Update Color Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../color/show_color.php">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
					$sql = "SELECT * FROM colors WHERE color_id=$color_id";
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
								<input type="text" class="form-control" id="color_name" name="color_name" value="<?php echo $row['color_name'] ?>" placeholder="Enter name" required>
								<input type="hidden" class="form-control" id="color_id" name="color_id" value="<?php echo $color_id ?>" placeholder="Enter name" required>
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
		include("../../include/main_file/footer.php");
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
			
			var color_id = $("#color_id").val();

            var userInputColor = $("#color_name").val();
			var color = userInputColor.toLowerCase();
			var found = false;
			var colors = [
				'red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink',
				'brown', 'gray', 'black', 'white', 'cyan', 'magenta', 'turquoise',
				'gold', 'silver', 'indigo', 'maroon', 'olive', 'teal'
			];
            
			
			for (var i = 0; i < colors.length; i++) {
				
				if (userInputColor === colors[i]) {
					
					 found = true;
					 var isValid = true;

                if (color_name === "") {
                    isValid = false;
                }

                if (!isValid) {
                    alert("Name and Image URL are required.");
                } else {
                    // AJAX to submit form data
                    $.ajax({
                        type: "POST",
                        url: "../../../functions/function_ajax.php", // Replace with the actual server-side processing script
                        data: {
							action:"update_color",
                            color_name: color_name,
							color_id: color_id
                        },
                        success: function (response) {
                            if (response === "success") {
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
				alert("Please Don't Correct Value  ");
			} 
			
			
        });
    });
</script>

</body>
</html>
