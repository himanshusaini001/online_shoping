<?php
// For demonstration purposes
	if (isset($_SESSION['msg']) && $_SESSION['msg'] != ''  ) {
		?>
		<h6 id="message" class="active_id" style="display:none;"><?php echo $_SESSION['msg'] ?></h6>
			<script>
				document.getElementById('message').style.display = 'block';
				setTimeout(function() {
				document.getElementById('message').style.display = 'none';
				}, 3000); // 3 seconds
			</script>
		<?php
			$_SESSION['msg'] = "";
			} 
			if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') 
			{
				?>
					<h6 id="message2" class="Inactive_id" style="display:none;"><?php echo $_SESSION['msg'] ?></h6>
					<script>
						document.getElementById('message2').style.display = 'block';
						setTimeout(function() {
						document.getElementById('message2').style.display = 'none';
						}, 3000); // 3 seconds
					</script>
				<?php
				$_SESSION['msg'] = "";
			}
			
?>