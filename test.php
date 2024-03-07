<?php 

   include("../../include/db_file/connection_file.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Data Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2>Management Size</h2>
            
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
						while ($row = $result->fetch_assoc()) {
							$sh++;
				?>
                    <!-- Dummy Data -->
                    <tr>
                        <td><?php echo $sh ?></td>
                        <td><?php echo $row['size'] ?></td>
                        <td></td>
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
