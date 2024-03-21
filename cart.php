<!-- header Start -->
<?php 
    require_once('include/db_file/config.php');
    require_once('include/db_file/connection_file.php');
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
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <tr>
                        <td class="align-middle"><img src="<?php echo DTS_WS_SITE_IMG ?>product-1.jpg" alt="" style="width: 50px;"> <?php echo $row['product_name'] ?></td>
                        <td class="align-middle"><?php echo $row['price'] ?></td>
                        <input type="hidden" class="form-control" id="price" name="price" value="<?php echo $row['price'] ?>">
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn" >
                                    <button class="btn btn-sm btn-primary btn-minus" onclick="auto_change_qut_1()" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
								<input type="number" id="qut_change"  name="qut_change" min="1" max="5" class="form-control form-control-sm bg-secondary border-0 text-center qut_change" value="<?php echo $qut; ?>">
								<div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus" id="block_function" onclick="auto_change_qut_2()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle total_amount" id="total_amount_p"><?php echo $total ?></td>
                        
						<input type="hidden" id="price" name="price" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $row['price'] ?>">
						<input type="hidden" id="stock"  name="stock" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $row['stock'] ?>">
                       <input type="hidden" id="product_name"  name="product_name" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $row['product_name'] ?>">
					   
					   <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
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
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" onclick="checkout()">Proceed To Checkout</button>
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
	var qut = document.getElementById('qut_change').value;
	var total_qut = parseInt(qut) - 1;
	var stock = document.getElementById('stock').value;
	var price = document.getElementById('price').value;
	if(total_qut !== stock)
	{
		 var button = document.getElementById("block_function");
		// Disable the button
		button.disabled = false;
	}
	if(total_qut == "0")
	{
		var total_amount = "0";
	}
	else{
		var total_amount = total_qut * price;
	}
	document.getElementById('total_amount').innerText = total_amount;
	document.getElementById('amount').innerText = total_amount;
	document.getElementById('all_amount').innerText = total_amount;
}

function auto_change_qut_2() {
	
	var qut = document.getElementById('qut_change').value;
	var total_qut = parseInt(qut) + 1;
	var stock = document.getElementById('stock').value;
	if(total_qut == stock)
	{
		alert("Only Available Stock " + stock);
		 var button = document.getElementById("block_function");
		// Disable the button
		button.disabled = true;
	}
	if(total_qut > stock)
	{
		alert("Only Available Stock " + stock);
		
		
		document.getElementById('qut_change').value = stock; 
	
		
	}
	else{
		
		var price = document.getElementById('price').value;
		
		var total_amount = total_qut * price;

		document.getElementById('total_amount_p').innerText = total_amount;
		document.getElementById('amount').innerText = total_amount;
		document.getElementById('all_amount').innerText = total_amount;
		
	}
    
   
}

function checkout()
{
	var qut = document.getElementById('qut_change').value;
	var product_name = document.getElementById('product_name').value;
	var all_amount = document.getElementById('all_amount').textContent;
	
	//window.location = "checkouts.php";
	window.location = "checkout.php?product_name=" + encodeURIComponent(product_name) + "&qut=" + encodeURIComponent(qut)  + "&all_amount=" + encodeURIComponent(all_amount) ;
}
</script>
</body>
</html>
