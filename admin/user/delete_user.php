
<?php 
//Start Config File

	require_once('../include/db_file/config.php');
	require_once('../include/db_file/connection_file.php');
//End Config File

// Session Start
	if(!isset($_SESSION['admin_name']))
	{
			header("location:../index.php");
	}
		
// Session End
$sid = $_GET['sid'];
$sql = "SELECT *  FROM user WHERE sid= $sid";
$result = $conn->query($sql);
$mail_row = $result->fetch_assoc();
$email = $mail_row['email']
?>

<!-- Start Form Tag -->

<form id="addForm">
	<input type="hidden" name="action" value="delete_user">
	<input type="hidden" id="sid" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" id="email" name="email" value="<?php echo $email ?>">
</form>

<!-- End Form Tag -->

<!-- Start Script Tag -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
	(function() {
		// Your code
		var sid = $("#sid").val();

		// Confirm before deleting
		if (confirm('Are you sure you want to delete this record?')) {
			// AJAX request to delete record
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
				
					window.location.href = 'show_user.php';
				},
				error: function (xhr, status, error) {
					console.error('AJAX request failed:', status, error);
					alert('Failed to delete the record.');
				}
			});
		}
		else
		{
			window.location.href = 'show_user.php';
		}
	})();
</script>

<!-- End Script Tag -->
