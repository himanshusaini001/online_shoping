<?php

    // Top Link Start 
	
		include("../../include/main_file/top_link.php");
		include("../../include/db_file/connection_file.php");
	
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
            <h1 class="m-0">Manage Sizes</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../home.php">Home</a></li>
              <li class="breadcrumb-item active"><span><a href="add_size.php" class="btn btn-primary">Add Size</a></span></li>
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
				<div class="col-md-1">
				</div>
				<div class="col-md-10">
					<div class="container mt-4">
						<div class="row">
							<div class="col-12">
								<table id="dataTable" class="table table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sh = 0;
											$sql = "SELECT * FROM clothing_sizes";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) 
												{
													$sh++;
										?>
													<!-- Dummy Data -->
													<tr>
														<td><?php echo $sh ?></td>
														<td><?php echo $row['size'] ?></td>
														<td> <a class='btn ' href="update_size.php?sid=<?php echo $row['sid'] ?>"><i class="fa fa-edit "  aria-hidden="true"></i></a><a class='btn ' href="delete_size.php?sid=<?php echo $row['sid'] ?>"><i class="fa fa-trash edit_icon" aria-hidden="true"></i></a></td>
													</tr>
													<!-- Add more rows as needed -->
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
				<div class="col-md-1">
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
<script>
    $(document).ready(function() {
        // DataTable Initialization
        var dataTable = $('#dataTable').DataTable();

        // Search Bar
        $('#search').on('keyup', function () {
            dataTable.search(this.value).draw();
        });

        // Entries per page
        $('#entries').on('change', function () {
            dataTable.page.len(this.value).draw();
        });
    });
</script>


</body>
</html>
