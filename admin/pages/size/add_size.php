<?php

    // Top Link Start 
	
		include("../../include/main_file/top_link.php");
	
	 // Top Link Start
	
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
            <h1 class="m-0">Add Size Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../profile/home.php">Home</a></li>
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
								<label for="cname">Size:</label>
								<input type="text" class="form-control" id="size" name="size" placeholder="Enter Size" required>
							</div>
							
							<!-- Status Field -->
							<div class="form-group">
								<label for="selectOption" >Select an option:</label>
								<select type="text" class="form-control"  id="status" name="status" placeholder="Enter status URL"  required>
								<option value="0">Active</option>
								<option value="1">Inactive</option>
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

            var uppercaseText = $("#size").val();
            var size = uppercaseText.toUpperCase();
			 var status = $("#status").val();

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
                        url: "../../../functions/function_ajax.php", // Replace with the actual server-side processing script
                        data: {
                            action: "add_size",
                            size: size,
							status: status
                        },
                        success: function (response) {
                            if (response === "success") {
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
        });
    });
</script>

</body>
</html>
