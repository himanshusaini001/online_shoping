
<?php

require_once('../include/db_file/config.php');
require_once("../include/db_file/connection_file.php");

include("../include/main_file/top_link.php");
include("../include/main_file/main_sidebar.php");

	if(!isset($_SESSION['admin_name']))
	{
			header("location:../index.php");
	}
	
	$product_id = $_GET['product_id'];
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
                    <h1 class="m-0">Add Category Page</h1>
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
				<?php 
					$sql = "SELECT * FROM product";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
						while($data = $result->fetch_assoc())
						{
							
					?>
					<input type="hidden" class="form-control" name="action" value="update_product" required>
                    <form class="custom-form shadow p-4" id="addForm" action="" method="post" enctype="multipart/form-data">
                        <!-- Name Field -->
						<input type="hidden" class="form-control"  name="action" value="update_product" placeholder="Enter image URL" required>
						<div class="row">
							<div class=" col-md-6">
								<div class="form-group">
									<label for="optInSelect">Product Categorys:</label>
									<select class="form-control" id="category" name="category" placeholder="Enter Categorys" required>
										 <option>select Category</option>
										<?php 
											$sql="SELECT * FROM category";
											$result = $conn->query($sql);
											// Populate select options with data from the database
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
										?>
											  <option value="<?php echo $row['cid'] ?>"> <?php echo $row['cname'] ?></option>
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
											$sql="SELECT * FROM colors";
											$result = $conn->query($sql);
											// Populate select options with data from the database
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
										?>
											  <option value="<?php echo $row['color_name'] ?>"><?php echo $row['color_name'] ?></option>
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
											$sql="SELECT * FROM clothing_sizes";
											$result = $conn->query($sql);
											// Populate select options with data from the database
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
										?>
											  <option value="<?php echo $row['size'] ?>"><?php echo $row['size'] ?></option>
										<?php
												}
											} else {
												echo "0 results";
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="cname">Product Price:</label>
									<input type="number" class="form-control" id="price" name="price" value="<?php echo $data['price'] ?>" maxlength="10" placeholder="Enter name" required>
								</div>
							</div>
							<div class=" col-md-6">
								<div class="form-group">
									<label for="cname">Product Name:</label>
									<input type="text" class="form-control"  name="product_name" placeholder="Enter name" id="product_name" value="<?php echo $data['product_name'] ?>" required>
								</div>
								<div class="form-group">
									<label for="cname">Product description:</label>
									<textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="<?php echo $data['description'] ?>" required><?php echo $data['description'] ?></textarea>
								</div>

								<!-- Image Field -->
								<div class="form-group">
									<label for="img">Image:</label>
									<input type="file" class="form-control" id="product_img" name="product_img" placeholder="Enter image URL" value="<?php echo $data['product_img'] ?>" accept="image/*" required><img src="../../admin/assets/upload_img/<?php echo $data['product_img'] ?>" width="50px" height="50px" >
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
								<input type="hidden" class="form-control" id="product_id" name="product_id" value="<?php echo $product_id ?>" placeholder="Enter name" required>
								<button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
							</div>
						</div>
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

			var category = $("#category").val();
			var product_color = $("#product_color").val();
			var product_size = $("#product_size").val();
			var price = $("#price").val();
			var product_name = $("#product_name").val();
			var description = $("#description").val();
			var product_img = $("#product_img").val();
			var status = $("#status").val();
			var product_id = $("#product_id").val();
			

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
                        if (response === "success") {
                            // Redirect to another page after successful insertion
                            window.location.href = "../product/show_product.php";
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
