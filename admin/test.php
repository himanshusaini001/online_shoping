 <script>
        $(document).ready(function () {
            // Form validation using jQuery
            $("#submitBtn").click(function () {
                // Reset previous error messages
                $(".error-message").text("");

                var uppercaseText = $("#size").val();
				var size = uppercaseText.toUpperCase();
				
				if (size === "XS" || size === "S" || size === "M" || size === "L" || size === "XL" || size === "XXL" || size === "XXXL") {
				var isValid = true;

                if (size === "") {
                    isValid = false;
                }
				
                if (!isValid) {
                    alert("Name and Image URL are required.");
                } else {
                    // AJAX to submit form data
                    $.ajax({
                        type: "POST",
                        url: "../../../functions/function_ajax.php", // Replace with the actual server-side processing script
                        data: {
							action:"add_size",
                            size : size
                        },
                        success: function (response) {
                            if (response === "success") {
                                // Redirect to another page after successful insertion
                                window.location.href = "../size/show_size.php";
                            } else {
                                alert("Size is Already Added");
                            }
                        },
                        error: function (xhr, status, error) {
                            alert("AJAX request failed: " + status + "\nError: " + error);
                        }
                    });
                }
				} else {
					let sizesList = ["XS", "S", "M", "L", "XL", "XXL", "XXXL"];
					sizesList.push(size);
					console.log("Added size to the list:", sizesList);
					// Your code for the false condition goes here
				}
                
            });
        });
    </script>