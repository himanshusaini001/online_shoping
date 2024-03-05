<?php

include('../include/db_file/config.php');
if(!isset($_SESSION['admin']))
{
	header("location: login.php");
}
 
?>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title></title>
        <link href='http://fonts.googleapis.com/css?family=Questrial|Droid+Sans|Alice' rel='stylesheet' type='text/css'>
  <link href="../assets/css/front_style.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
    <body class="profile_body">
        <div class="container">
            <div class="row">
                <div class="profile_img">
                <img id="postcard" src="../assets/img/profile_img/profile.png" alt="postcard" class="img-responsive move">
              </div>
			<div id="content" >
                    <h1> Your Profile  </h1>

                    <form role="form">
                        <div class="form-group">
                            <label for="username" > Name : <?php echo  $_SESSION['fname'] ?>  <?php echo  $_SESSION['lname'] ?></label>
                          </div>
						<div class="form-group">
                            <label for="username" > E-mail : <?php echo  $_SESSION['email'] ?> </label>
                        </div>
						<div class="form-group">
                            <label for="username" > Phone : <?php echo  $_SESSION['phone'] ?> </label>
                        </div>
						<div class="form-group">
                            <label for="username" > Address : <?php echo  $_SESSION['address'] ?> </label>
                        </div>
						<div class="form-group">
                           <a class="btn btn-primary" href="../index.php">Back Home</a>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </body>
</html>    
