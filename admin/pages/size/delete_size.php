<?php 
// Session Start

	include('../../include/db_file/config.php');
		if(!isset($_SESSION['admin_name']))
		{
				header("location:../../admin_login.php");
		}
	// Session End
$sid = $_GET['sid'];

?>
<input type="hidden" id="sid" value="<?php echo $sid ?>">

<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    // Delete button click event
(function() {
    // Your code
    var sid = $("#sid").val();

    // Confirm before deleting
    if (confirm('Are you sure you want to delete this record?')) {
        // AJAX request to delete record
        $.ajax({
            url: '../../../functions/function_ajax.php',
            type: 'POST',
            data: { 
                action: "delete_size",
                sid: sid 
            },
            success: function (response) {
                // Redirect after successful deletion
                window.location.href = 'show_size.php';
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                alert('Failed to delete the record.');
            }
        });
    }
	else
	{
		window.location.href = 'show_size.php';
	}
})();



</script>
