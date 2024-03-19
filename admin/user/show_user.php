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
<!-- Start Body  Tag -->
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
            <h1 class="m-0">Manage User</h1>
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
				<div class="col-md-1">
				</div>
				<div class="col-md-10">
					<div class="container mt-4">
						<div class="row">
							<div class="col-12" style="height: 400px; overflow: auto;">
								<table id="dataTable" class="table table-bordered">
									<thead>
										<tr>
											<th>Sh:</th>
											<th>Name</th>
											<th>E-mail</th>
											<th>Phone</th>
											<th>Addresss</th>
											<th>Created_at</th>
											<th>Update_at</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sh = 0;
											$sql = "SELECT * FROM user ORDER BY created_at DESC ";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) 
											{
												while ($row = $result->fetch_assoc()) 
												{
													$sh++;
										?>
													<!-- Dummy Data -->
													<tr>
													<td><b><?php echo $sh ?></b></td>
													<td><?php echo $row['fname'] . $row['lname'] ?></td>
													<td><?php echo $row['email'] ?></td>
													<td><?php echo $row['phone'] ?></td>
													<td><?php echo $row['address'] ?></td>
													<td><?php echo $row['created_at'] ?></td>
													<td><?php echo $row['updated_at'] ?></td>
													<td><?php echo $row['status'] ?></td>
													<td>
														<div class="status-switch" data-userid="<?php echo $row['sid']; ?>" data-email="<?php echo $row['email']; ?>" data-status="<?php echo $row['status']; ?>">
															<input type="checkbox" <?php echo ($row['status'] == '1') ? 'checked' : ''; ?> />
															<span class="slider"></span>
														</div>
													</td>
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
  
  <!-- Start Footer  Tag -->
	<?php 
		include("../include/main_file/footer.php");
	?>
	<!-- End Footer  Tag -->
  
</div>
<!-- ./wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Start Script  Tag -->
<script>
    $(document).ready(function() {
        // Toggle status switch
        $('.status-switch').on('click', function() {
            var userId = $(this).data('userid');
			var email = $(this).data('email');
            var currentStatus = $(this).data('status');
            if(currentStatus == 1)
			{
				var status = currentStatus - 1;
			}
			else
			{
				var status = currentStatus + 1;
			}

            $.ajax({
                type: 'POST',
                url: '../../functions/function_ajax.php', // Update this with the file handling the status update
                data: { action:"update_user",email:email, sid: userId, status: status },
                 success: function (response) {
						let resp = JSON.parse(response);
						if(resp.status)
						{
							if(resp.status == '1')
							{
								alert("your ID is Active!");
								window.location = window.location.origin+"/online-shoping/admin/user/show_user.php" ;
							}
							else{
								alert("your ID is Inactive!");
								window.location = window.location.origin+"/online-shoping/admin/user/show_user.php" ;
							}
							
							 
						}
						else{
							alert ("Do not Relocate");
						}
						
					},
                    error: function (xhr, status, error) { 
                        alert("AJAX request failed: " + status + "\nError: " + error);
                    }
            });
        });
    });
</script>

<!-- End Script  Tag -->
</body>
<!-- End Body  Tag -->
</html>
