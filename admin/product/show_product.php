<?php
include('../include/db_file/config.php');
include("../include/db_file/connection_file.php");

include("../include/main_file/top_link.php");
include("../include/main_file/main_sidebar.php");

if (!isset($_SESSION['admin_name'])) {
    header("location:../index.php");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="overflow-y: scroll; overflow-x: scroll; scrollbar-width: thin; scrollbar-color: #888 #f1f1f1;">
    <!-- Content Header (Page header) -->
    <div class="content-header border_bottom_header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h1 class="m-0">Manage Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active"><span><a href="../../admin/category/show_category.php"
                                    class="btn btn-primary">View Category</a></span></li>
                        <li class="breadcrumb-item active"><span><a href="../../admin/product/add_product.php"
                                    class="btn btn-primary">Add Product</a></span></li>
                        <li class="breadcrumb-item active"><span><a href="../../admin/admin_logout.php"
                                    class="btn btn-primary">Logout</a></span></li>
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
                                            <th>Product Name</th>
                                            <th>Product Color</th>
                                            <th>Product Size</th>
											<th>Product Description</th>
                                            <th>Product Price</th>
											<th>Product Img</th>
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
                                        <!-- Dummy Data -->
                                        <tr>
                                            <td><b><?php echo $sh ?></b></td>
                                            <td><?php echo $row['product_name'] ?></td>
                                            <td><?php echo $row['product_color'] ?></td>
                                            <td><?php echo $row['product_size'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
											<td><img src="../../admin/assets/upload_img/<?php echo  $row['product_img'] ?>" width="50px" height="50px"></td>
                                            <?php
                                                    if ($row['status'] == '0') {
                                                        $status = "Inactive";
                                                        $style = "color: red;";
                                                    } else {
                                                        $status = "Active";
                                                        $style = "color: green;";
                                                    }
                                                    ?>
                                            <td><p style="<?php echo $style; ?>"><?php echo $status; ?></p></td>
                                            <td> <a class='btn '
                                                    href="update_product.php?product_id=<?php echo $row['product_id'] ?>"><i
                                                        class="fa fa-edit edit_icon " aria-hidden="true"></i></a><a
                                                    class='btn '
                                                    href="delete_product.php?product_id=<?php echo $row['product_id'] ?>"><i
                                                        class="fa fa-trash delete_icon" aria-hidden="true"></i></a></td>
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

include("../include/main_file/footer.php");

?>

<!-- Bottom Slide Bar -->
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="dataTables_paginate paging_simple_numbers">
                <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                        <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                    </li>
                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                    </li>
                    <!-- Add more pages as needed -->
                    <li class="paginate_button page-item next" id="dataTable_next">
                        <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
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
