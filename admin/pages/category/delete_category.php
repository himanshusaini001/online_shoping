<?php 
$cid = $_GET['cid'];

?>
<input type="hidden" id="cid" value="<?php echo $cid ?>">

<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    // Delete button click event
(function() {
    // Your code
    var cid = $("#cid").val();

    // Confirm before deleting
    if (confirm('Are you sure you want to delete this record?')) {
        // AJAX request to delete record
        $.ajax({
            url: '../../../functions/function_ajax.php',
            type: 'POST',
            data: { 
                action: "delete_category",
                cid: cid 
            },
            success: function (response) {
                // Redirect after successful deletion
                window.location.href = 'show_category.php';window.location.href = 'show_category.php';
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                alert('Failed to delete the record.');
            }
        });
    }
	else
	{
		window.location.href = 'show_category.php';window.location.href = 'show_category.php';
	}
})();



</script>
