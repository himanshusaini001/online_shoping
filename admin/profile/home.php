
<?php
require_once("../include/main_file/top_link.php");
require_once("../include/main_file/main_sidebar.php");
if(!isset($_SESSION['admin_name']))
	{
			header("location:index.php");
	}
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
				</ol>
			</div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

	<div class="container mt-5">
	  <div class="jumbotron">
		<h1 class="display-4">Welcome to Your Profile</h1>
		<p class="lead">This is a simple profile page using Bootstrap.</p>
		<hr class="my-4">
		<p>Feel free to customize this page to showcase your information and content.</p>
	  </div>
	</div>
    
</div>
<!-- /.content-wrapper -->

<?php
include("../include/main_file/footer.php");
?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
