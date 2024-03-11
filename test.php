<?php 

   
include('include/db_file/config.php');
include("include/db_file/connection_file.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Dropdown with PHP and MySQL</title>
</head>
<body>

<label for="categorySelect">Select a category:</label>
<select id="categorySelect">
    <?php

    // Query to fetch data from the category table
    $sql = "SELECT * FROM category";
	
    $result = $conn->query($sql);
	
    // Populate select options with data from the database
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</select>

</body>
</html>
