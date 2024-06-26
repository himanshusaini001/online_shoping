
<?php 
//Start Config File

	require_once('../include/db_file/config.php');
	
//End Config File

// Session Start
	if(!isset($_SESSION['admin_name']))
	{
			header("location:../index.php");
	}
		
// Session End
$cid = $_GET['cid'];

?>

<!-- Start Form Tag -->

<form id="addForm">
	<input type="hidden" name="action" value="delete_category">
	<input type="hidden" id="cid" name="cid" value="<?php echo $cid ?>">
</form>

<!-- End Form Tag -->

<!-- Start Script Tag -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
	(function() {
		// Your code
		var cid = $("#cid").val();
		// Confirm before deleting
		if (confirm('Are you sure you want to delete this record?')) {
			// AJAX request to Delete record
			var form = document.getElementById('addForm');
			console.log(form);
			let formdata = new FormData(form);
			$.ajax({
				url: '../../functions/function_ajax.php',
				type: 'POST',
				data: formdata,
				processData: false,
				contentType: false,
				success: function (response) {
					// Redirect after successful deletion
				
					window.location.href = 'show_category.php';
				},
				error: function (xhr, status, error) {
					console.error('AJAX request failed:', status, error);
					alert('Failed to delete the record.');
				}
			});
		}
		else
		{
			window.location.href = 'show_category.php';
		}
	})();
</script>

<!-- End Script Tag -->
