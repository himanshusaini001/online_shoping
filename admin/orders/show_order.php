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
<style>
.active_id {
	background-color: #a4e9a4;
	padding: 10px;
	color:#000;
}
.Inactive_id {
	background-color: #ed6060;
	padding: 10px;
	color:#fff;
}
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

 
  <!-- Content Wrapper. Contains page Content -->
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
								<?php 
									include("../include/main_file/flash_message.php");
								?>
                                <table id="dataTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sh:</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>State</th>
                                            <th>Pin Code</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sh = 0;
										
										$sql ="SELECT * FROM billingaddress";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $sh++;
                                        ?>
                                                <!-- Displaying Product Data -->
                                                <tr>
                                                    <td><b><?php echo $sh ?></b></td>
                                                    <td><?php echo $row['first_name'] ." ".$row['last_name'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['address_line_1'] ?></td>
													<td><?php echo $row['state'] ?></td>
													<td><?php echo $row['pin_code'] ?></td>
													<?php 
													
													?>
                                                   <td>
                                                        <a class='btn' href="view_order.php?customer_id=<?php echo $row['customer_id'] ?>"><i class="fa fa-database blue_icon" aria-hidden="true"></i></a>
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
			try{
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
			}
			catch (e) {
				alert("An error occurred at line " + e.line + ": " + e.message);
            }
        });
    </script>
<!-- End Script Tag -->
</body>
</html>
