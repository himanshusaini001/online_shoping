<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Upload multiple image in Database using PHP MYSQL

if(isset($_POST['submit'])) {
   
	
	    
			 if($_FILES["multipleFile"]["name"] == "")
			 {
				echo "Do not add Img"; 
			 }
			 else
			 {
				 for($i=0;$i<count($_FILES["multipleFile"]["name"]);$i++)  
					{  
						 $img_src = $_FILES['multipleFile']['name'][$i];
						 $target_dir = "assets/test_upload/";
						$target_file = $target_dir . basename($_FILES['multipleFile']['name'][$i]);
						move_uploaded_file($_FILES['multipleFile']['tmp_name'][$i], $target_file);
						
						$sql="INSERT INTO test (add_img) VALUES ('$img_src')";
						if($conn->query($sql)) {
							echo "INSERT DATA ";
						} else {
							echo "Not INSERT DATA";
						}
					 }
			 }
	
}

?>

<div class="container">
  <div class="row">
     <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="alert alert-success alert-dismissible" id="success" style="display: none;">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          File uploaded successfully
        </div>
      <form id="submitForm" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" name="multipleFile[]" id="multipleFile" required="" multiple>
            <label class="custom-file-label" for="multipleFile">Choose Multiple Images to Upload</label>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-success btn-block">Upload File</button>
        </div>  
      </form>
    </div>
  </div>
  <!-- gallery view of uploaded images -->
  <div id="gallery"></div>
</div>


<?php 

$sql2="SELECT * FROM test";
		$result = $conn->query($sql2);
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				?>
						<img src="assets/test_upload/<?php echo  $row['add_img'] ?>" width="100px" height="100px">
				<?php 
			}
		}


?>