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
            <h1 class="m-0">Management Colors</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
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
						<div class="container mt-5">
					  

						  <!-- Search field and entries per page dropdown -->
						  <div class="row mb-3">
							<div class="col-md-4">
								<label for="entriesPerPage">Entries per page:</label>
							  <input type="text" class="form-control" id="search" placeholder="Search" onkeyup="searchTable()">
							</div>
							<div class="col-md-6">
							</div>
							<div class="col-md-2">
							  <label for="entriesPerPage">Entries per page:</label>
							  <select class="form-control" id="entriesPerPage" onchange="changeEntriesPerPage()">
								<option>5</option>
								<option>10</option>
								<option>20</option>
							  </select>
							</div>
						  </div>

						  <!-- Data Table -->
						  <table class="table" id="dataTable" border="0" cellspacing="0" class="category_table_style">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Color Name</th>
								<th>Action</th>
								
							  </tr>
							</thead>
							<?php 
								$sh = 0;
								$sql = "SELECT * FROM colors";
								$result = $conn->query($sql);
								if($result->num_rows > 0)
								{
									while($row = $result->fetch_assoc())
									{
										$sh++
							?>
							<tbody>
								 <tr>
								<td><?php echo $sh ?></td>
								<td><?php echo $row['color_name'] ?></td>
								<td> <a class='btn ' href="update_color.php?color_id=<?php echo $row['color_id'] ?>"><i class="fa fa-edit "  aria-hidden="true"></i></a><a class='btn ' href="delete_color.php?color_id=<?php echo $row['color_id'] ?>"><i class="fa fa-trash edit_icon" aria-hidden="true"></i></a></td>
								
							  </tr>
							</tbody>
							<?php 			
									}
									
								}
							?>
						  </table>

					  <!-- Pagination -->
					  <nav aria-label="Page navigation">
						<ul class="pagination justify-content-end">
						  <!-- Pagination links will be dynamically generated here -->
						</ul>
					  </nav>

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
  var entriesPerPage = 5; // Default number of entries per page
  var currentPage = 1; // Default current page

  function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      // Assuming you want to search in the second column (index 1), adjust as needed
      td = tr[i].getElementsByTagName("td")[1];

      if (td) {
        txtValue = td.textContent || td.innerText;

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    currentPage = 1; // Reset current page after searching
    updatePagination();
  }

  function changeEntriesPerPage() {
    var select = document.getElementById("entriesPerPage");
    entriesPerPage = parseInt(select.value);
    currentPage = 1;
    updateTable();
  }

  function updateTable() {
    var table = document.getElementById("dataTable");
    var tr = table.getElementsByTagName("tr");

    var startIndex = (currentPage - 1) * entriesPerPage;
    var endIndex = startIndex + entriesPerPage;

    for (var i = 0; i < tr.length; i++) {
      if (i >= startIndex && i < endIndex) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }

    updatePagination();
  }

  function updatePagination() {
    var table = document.getElementById("dataTable");
    var tr = table.getElementsByTagName("tr");
    var totalPages = Math.ceil(tr.length / entriesPerPage);

    var pagination = document.querySelector(".pagination");
    pagination.innerHTML = "";

    for (var i = 1; i <= totalPages; i++) {
      var li = document.createElement("li");
      li.className = "page-item" + (i === currentPage ? " active" : "");
      var a = document.createElement("a");
      a.className = "page-link";
      a.href = "#";
      a.innerText = i;
      a.addEventListener("click", function (event) {
        event.preventDefault();
        currentPage = parseInt(event.target.innerText);
        updateTable();
      });
      li.appendChild(a);
      pagination.appendChild(li);
    }
  }

  // Call updateTable after adding or removing rows to initialize the table
  updateTable();
</script>
	

</body>
</html>
