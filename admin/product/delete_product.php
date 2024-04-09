
<?php 
// Session Start

	require_once('../include/db_file/config.php');
		if(!isset($_SESSION['admin_name']))
		{
				header("location:../index.php");
		}
	// Session End
$product_id = $_GET['product_id'];

?>
<form id="addForm">

<input type="hidden" name="action" value="delete_product">

<input type="hidden" id="product_id"  name="product_id" value="<?php echo $product_id ?>">

</form>

<!-- Include jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    // Delete button click event
(function() {
    // Your code
    var product_id = $("#product_id").val();

    // Confirm before deleting
    if (confirm('Are you sure you want to delete this record?')) {
        // AJAX request to delete record
		var form = document.getElementById('addForm');
		let formdata = new FormData(form);
				
        $.ajax({
            url: '../../functions/function_ajax.php',
            type: 'POST',
             data: formdata,
			processData: false,
			contentType: false,
            success: function (response) {
                // Redirect after successful deletion
                window.location.href = 'show_product.php';
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                alert('Failed to delete the record.');
            }
        });
    }
	else
	{
		window.location.href = 'show_product.php';
	}
})();



</script>
