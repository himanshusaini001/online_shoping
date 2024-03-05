<script> 

var userInputColor = prompt("Enter a color:");

// Convert the user input to lowercase to make the comparison case-insensitive
userInputColor = userInputColor.toLowerCase();

var colorToDisplay = 'Default Color'; // Default color or message

// List of colors
var colors = [
    'red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink',
    'brown', 'gray', 'black', 'white', 'cyan', 'magenta', 'turquoise',
    'gold', 'silver', 'indigo', 'maroon', 'olive', 'teal'
];

// Iterate through the list of colors using a for loop
for (var i = 0; i < colors.length; i++) {
    if (userInputColor === colors[i]) {
        colorToDisplay = userInputColor;
        break; // Exit the loop if a match is found
    }
}

// Display the alert with the chosen color

</script>

<script>
    $(document).ready(function () {
        // Form validation using jQuery
        $("#submitBtn").click(function () {
            // Reset previous error messages
            $(".error-message").text("");
			
            var userInputColor = $("#color").val();
			var color = userInputColor.toLowerCase();

			var colors = [
				'red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink',
				'brown', 'gray', 'black', 'white', 'cyan', 'magenta', 'turquoise',
				'gold', 'silver', 'indigo', 'maroon', 'olive', 'teal'
			];
            
			
			for (var i = 0; i < colors.length; i++) {
				if (userInputColor === colors[i]) {
					var isValid = true;

					if (color === "") {
						isValid = false;
						alert("Fild is required.");
					}

					if (isValid) {
						// AJAX to submit form data
						$.ajax({
							type: "POST",
							url: "../../../functions/function_ajax.php", // Replace with the actual server-side processing script
							data: {
								action: "add_color",
								color: color
							},
							success: function (response) {
								if (response === "success") {
									// Redirect to another page after successful insertion
									window.location.href = "../color/show_color.php";
								} else {
									alert("Color is Already Added");
								}
							},
							error: function (xhr, status, error) {
								alert("AJAX request failed: " + status + "\nError: " + error);
							}
						});
					}
					break; // Exit the loop if a match is found
				}
			}
			
			alert("The chosen color is: " + colorToDisplay);

				
			
        });
    });
</script>