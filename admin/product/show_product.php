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
     <div class="content-header border_bottom_header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h1 class="m-0">Manage Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><span><a href="../../admin/category/show_category.php" class="btn btn-primary">View Category</a></span></li>
                            <li class="breadcrumb-item active"><span><a href="../../admin/product/add_product.php" class="btn btn-primary">Add Product</a></span></li>
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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-12" style="height: 400px; overflow: auto;">
                                <table id="dataTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sh:</th>
                                            <th>Name</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sh = 0;
                                        $sql = "SELECT * FROM product";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $sh++;
                                        ?>
                                                <!-- Displaying Product Data -->
                                                <tr>
                                                    <td><b><?php echo $sh ?></b></td>
                                                    <td><?php echo $row['product_name'] ?></td>
                                                    <td><?php echo $row['product_color'] ?></td>
                                                    <td><?php echo $row['product_size'] ?></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['description'] ?></td>
													<?php 
													
													?>
                                                    <td>
														<?php 
														// Check if there are images for this product
														if (!empty($row['product_img'])) {
															$images = explode(",", $row['product_img']);
															foreach ($images as $key=>$image) {
																if($key == '0')
																{
																	echo "<img src='../../upload_img/$image' width='50px' height='50px'>";
																}
																
															}
														}
														?>
													</td>
                                                    <?php
                                                    $status = ($row['status'] == '0') ? "Inactive" : "Active";
                                                    $style = ($row['status'] == '0') ? "color: red;" : "color: green;";
                                                    ?>
                                                    <td><p style="<?php echo $style; ?>"><?php echo $status; ?></p></td>
                                                    <td>
                                                        <a class='btn' href="update_product.php?product_id=<?php echo $row['product_id'] ?>"><i class="fa fa-edit edit_icon" aria-hidden="true"></i></a>
                                                        <a class='btn' href="delete_product.php?product_id=<?php echo $row['product_id'] ?>"><i class="fa fa-trash delete_icon" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <!-- /.content -->
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
	<script>
        $(document).ready(function() {
            // DataTable Initialization
            var dataTable = $('#dataTable').DataTable();

            // Search Bar
            $('#search').on('keyup', function() {
                dataTable.search(this.value).draw();
            });

            // Entries per page
            $('#entries').on('change', function() {
                dataTable.page.len(this.value).draw();
            });
        });
    </script>
<!-- End Script Tag -->
</body>
</html>
