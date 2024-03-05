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
            <h1 class="m-0">Show Size Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../size/show_color.php">Home</a></li>
              <li class="breadcrumb-item active"><span><a href="add_color.php" class="btn btn-primary">Add Color</a></span></li>
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
				   <div class="col-md-1">
				   </div>
					<div class="col-md-10">
						<!--div class="alert alert-success mt-5" role="alert">
							Data has been successfully submitted!
						</div-->
						<table id="main" border="0" cellspacing="0" class="category_table_style">
						<tr>
						<tr>
							<td id="table">
								
							</td>
						</tr>
						<tr>
							<td id="table-data">
							</td>
						</tr>
					</table>
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
	<script type="text/javascript">
		(function() {
			// Your code
			var sid = $("#sid").val();
			// Confirm before deleting
			if (confirm) {
				// AJAX request to delete record
			   $.ajax({
					url: "../../../functions/function_ajax.php",
					type: "POST",
					data: {
						action:"fetch_color"
					},
					success: function (data) {
						$("#table-data").html(data)
					}
				});
			}
			else
			{
				window.location.href = 'show_size.php';
			}
		})();

	</script>
</body>
</html>
