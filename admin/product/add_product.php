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
<!-- Start body Tag -->
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
                    <h1 class="m-0">Add Product Page</h1>
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
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <form class="custom-form shadow p-4" id="addForm" action="" method="post" enctype="multipart/form-data" style="height: 400px; overflow: auto;">
                        <!-- Name Field -->
						<input type="hidden" class="form-control"  name="action" value="add_product" placeholder="Enter image URL" required>
						<div class="row">
							<div class=" col-md-6">
								<div class="form-group">
									<label for="optInSelect">Product Categorys:</label>
									<select class="form-control" id="category" name="category" placeholder="Enter Categorys" required>
										 <option>select category</option>
										<?php 
											$sql1="SELECT * FROM category";
											$result1 = $conn->query($sql1);
											// Populate select options with data from the database
											if ($result1->num_rows > 0) {
												while($row1 = $result1->fetch_assoc()) {
										?>
											  <option value="<?php echo $row1['cid'] ?>"><?php echo $row1['cname'] ?></option>
										<?php
												}
											} else {
												echo "0 results";
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="optInSelect">Product Colors:</label>
									<select class="form-control" id="product_color" name="product_color" placeholder="Enter colors" required>
									<option>select colors</option>
										<?php 
											$sql2="SELECT * FROM colors";
											$result2 = $conn->query($sql2);
											// Populate select options with data from the database
											if ($result2->num_rows > 0) {
												while($row2 = $result2->fetch_assoc()) {
										?>
											  <option value="<?php echo $row2['color_name'] ?>"><?php echo $row2['color_name'] ?></option>
										<?php
												}
											} else {
												echo "0 results";
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="optInSelect">Product Sizes:</label>
									<select class="form-control" id="product_size" name="product_size" placeholder="Enter sizes" required>
									<option>select sizes</option>
										<?php 
											$sql3="SELECT * FROM clothing_sizes";
											$result3 = $conn->query($sql3);
											// Populate select options with data from the database
											if ($result3->num_rows > 0) {
												while($row3 = $result3->fetch_assoc()) {
										?>
											  <option value="<?php echo $row3['size'] ?>"><?php echo $row3['size'] ?></option>
										<?php
												}
											} else {
												echo "0 results";
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="cname">Product Stock:</label>
									<input type="number" class="form-control" id="product_stock" name="product_stock"  placeholder="Enter Stock" required>
								</div>
								<div class="form-group">
									<label for="cname">Product Price:</label>
									<input type="number" class="form-control" id="price" name="price" maxlength="10" placeholder="Enter name" required>
								</div>
							</div>
							<div class=" col-md-6">
								<div class="form-group">
									<label for="cname">Product Name:</label>
									<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter name" required>
								</div>
								<div class="form-group">
									<label for="cname">Product description:</label>
									<textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description" required></textarea>
								</div>

								<!-- Image Field -->
								<div class="form-group">
									<label for="img">Image:</label>
									<input type="file" class="form-control" id="product_img[]" name="product_img[]" placeholder="Enter image URL" accept="image/*" multiple  required>
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
							</div>
						</div>
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

				var category = $("#category").val();
				var product_color = $("#product_color").val();
				var product_size = $("#product_size").val();
				var product_stock = $("#product_stock").val();
				var price = $("#price").val();
				var product_name = $("#product_name").val();
				var description = $("#description").val();
				var product_img = $("#product_img").val();
				var status = $("#status").val();
				
				if (!/^[a-zA-Z]+$/.test(product_name)) {
					alert("Check name field, add only characters." );
				}
				else{
					 var isValid = true;

				if (category === "") {
					isValid = false;
				}

				if (product_color === "") {
					isValid = false;
				}
				if (product_size === "") {
					isValid = false;
				}
				if (product_stock === "") {
					isValid = false;
				}
				if (price === "") {
					isValid = false;
				}
				if (product_name === "") {
					isValid = false;
				}
				if (description === "") {
					isValid = false;
				}
				
				if (status === "") {
					isValid = false;
				}

				if (!isValid) {
					alert("Name and Image URL are required.");
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
							var res = JSON.parse(response);
							if (res.status) {
							   window.location = window.location.origin+"/online-shoping/admin/product/show_product.php" ;
							} else {
								alert("Error: Not Relocate");
							}
						},
						error: function (xhr, status, error) {
							alert("AJAX request failed: " + status + "\nError: " + error);
						}
					});
				}
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
<!-- End body Tag -->
</html>
