<?php

    // Top Link Start 
	
		include("../../include/main_file/top_link.php");
	
	 // Top Link Start
	 
	// Navbar Start 
	
		include("../../include/main_file/navbar.php");
	
	// Navbar End
	
	// Sidebar Start 
	
		include("../../include/main_file/main_sidebar.php");
	
	// Sidebar End
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header border_bottom_header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Color Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../color/add_color.php">Home</a></li>
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
					   <form class="custom-form shadow p-4" id="addForm" action="#" method="post" enctype="multipart/form-data">
							<!-- XS Size Field -->
							<div class="form-group">
								<label for="cname">Color:</label>
								<input type="text" class="form-control" id="color" name="color" placeholder="Enter Size" required>
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
			
            var userInputColor = $("#color").val();
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
					if (color === "") {
						isValid = false;
						alert("Fild is required.");
					}

					if (isValid) {
						// AJAX to submit form data
						$.ajax({
							type: "POST",
							url: "../../../functions/function_ajax.php", // Replace with the actual server-side processing script
							data: {
								action: "add_color",
								color: color
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
