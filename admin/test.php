<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with AJAX</title>
  
</head>
<body>

    <form id="myForm">
        <label for="cname">Name:</label>
        <input type="text" id="cname" name="cname" required>

        <label for="cimg">Image URL:</label>
        <input type="text" id="cimg" name="cimg" required>

        <button type="submit">Submit</button>
    </form>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to handle form submission
            $("#myForm").submit(function (e) {
                e.preventDefault(); // Prevent the form from submitting in the traditional way

                // Get form data
                
                    var cname = $("#cname").val();	
                    var cimg = $("#cimg").val();
               

                // Send AJAX request to update data
                $.ajax({
                    type: "POST",
                    url: "../functions/function_ajax.php", // Replace with the actual backend URL
                    data: {
						action:"update_category",
						cname:cname,
						cimg:cimg
					},
                    success: function (response) {
                        // Redirect to another page after successful update
                        window.location.href = "pages/category/show_category.php"; // Replace with the desired page URL
                    },
                    error: function (error) {
                        console.error("Error updating data: " + JSON.stringify(error));
                    }
                });
            });
        });
    </script>
</body>
</html>
