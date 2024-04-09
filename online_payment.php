<?php 
	// Include database Configuration
    require_once('include/db_file/config.php');
    require_once('include/db_file/connection_file.php');
	// Include topbar file
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');

    // Initialize variables from GET parameters
    $qut = isset($_GET['qut']) ? $_GET['qut'] : 1;
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 0;

    // Fetch product details based on product_id
    $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total = $qut * $row['price'];
    $stock = $row['stock'];
?>

<!-- header End -->

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <h4 style="color:#ffd333"><b>Select a payment method</b></h4>
			<div class="payment_method_box">
				
			</div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Amount</h6>
                        <h6 class="font-weight-medium total_amount" id="amount"><?php echo $total ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery Charges</h6>
                        <?php 
                            if($total < '3000' ) {
                                $total += 40;
                        ?>
                                <h6 class="font-weight-medium">40</h6>
                        <?php } else { ?>
                                <h6 class="font-weight-medium">0</h6>
                        <?php 
							} 
						?>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 class="font-weight-medium all_amount" id="all_amount"><?php echo $total ?></h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" onclick="checkout()">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<!-- Footer Start -->
<?php 
    include('include/main_file/footer.php');
?>
<!-- Footer End -->

<script>
function auto_change_qut_1() 
{
	try{
		var qut = document.getElementById('qut_change').value;
		var total_qut = parseInt(qut) - 1;
		
		var price = document.getElementById('price').value;
		
		
		if(stock > qut)
		{
			var btn_plus = document.getElementById('block_function');
				btn_plus.style.pointerEvents = "auto";
				var total_amount = total_qut * price;
				document.getElementById('all_amount').innerText = total_amount;
				document.getElementById('amount').innerText = total_amount;
				document.getElementById('total_amount_p').innerText = total_amount;

		}
		else
		{
			if(total_qut == '0')
			{
				console.log(total_qut);
				var btn_plus = document.getElementById('block_function1');
				btn_plus.style.pointerEvents = "none";
				
				total_amount = '0';
				document.getElementById('all_amount').innerText = total_amount;
				document.getElementById('amount').innerText = total_amount;
				document.getElementById('total_amount_p').innerText = total_amount;
			}
			else{
				console.log(stock);
				var total_amount = total_qut * price;
				console.log(total_amount);
				document.getElementById('all_amount').innerText = total_amount;
				document.getElementById('amount').innerText = total_amount;
				document.getElementById('total_amount_p').innerText = total_amount;
			}
		}
	}catch (error) {
		console.error("Error occurred:", error);
	}
		
}

function auto_change_qut_2() {
	
	var qut = document.getElementById('qut_change').value;
	var total_qut = parseInt(qut) + 1;
    var price = document.getElementById('price').value;
	var stock = document.getElementById('stock').value;
	
	
	if(stock <= total_qut)
	{
		var total_amount = total_qut * price;
		document.getElementById('all_amount').innerText = total_amount;
		document.getElementById('amount').innerText = total_amount;
		document.getElementById('total_amount_p').innerText = total_amount;
		var btn_plus = document.getElementById("block_function");
		// Disable the button
		btn_plus.style.pointerEvents = "none";
		alert("Only Available Stock" + stcok);
	}
	else{
		var total_amount = total_qut * price;
		document.getElementById('all_amount').innerText = total_amount;
		document.getElementById('amount').innerText = total_amount;
		document.getElementById('total_amount_p').innerText = total_amount;
	}
	
}

function checkout()
{
	var qut = document.getElementById('qut_change').value;
	var product_name = document.getElementById('product_name').value;
	var product_id = document.getElementById('product_id').value;
	var all_amount = document.getElementById('all_amount').textContent;
	
	//window.location = "checkouts.php";
	window.location = "checkout.php?product_name=" + encodeURIComponent(product_name) + "&qut=" + encodeURIComponent(qut)  + "&all_amount=" + encodeURIComponent(all_amount)  + "&product_id=" + encodeURIComponent(product_id) ;
}
</script>
</body>
</html>
