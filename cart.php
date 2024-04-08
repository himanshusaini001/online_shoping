<?php 
    require_once('include/db_file/config.php');
    require_once('include/db_file/connection_file.php');
	if(!isset($_SESSION['customer_login'])) {
        header("location: customer_login.php");
        exit; // Add exit after header redirect to stop further execution
    }
	$customer_id = $_SESSION['customer_id'];
	
    include('include/main_file/topbar.php');
    include('include/main_file/header.php');
	 
	 // Initialize total_price variable
	
?>
<!-- header Start -->

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
                        <th>Remove</th>
                    </tr>
				
                </thead>
                <tbody class="align-middle">
					<?php 
					
						$sql = "SELECT * FROM add_to_cart WHERE customer_id='$customer_id'";
						$result = $conn->query($sql);
						$total_amount = 0;
						if($result->num_rows > 0)
						{
							while($row = $result->fetch_assoc())
							{
									$total_amount += $row['total_price'];
					?>
                    <tr>
                        <td class="align-middle"><img src="<?php echo DTS_WS_SITE_IMG ?>product-1.jpg" alt="" style="width: 50px;"> <?php echo $row['cart_name'] ?></td>
                        <td class="align-middle"><?php echo $row['cart_price'] ?></td>
							
						
						<td class="align-middle">
							<div class="input-group quantity mx-auto" style="width: 100px;">
								<div class="input-group-btn">
									<button class="btn btn-sm btn-primary btn-minus link1" id="btn_minus"
									data-product_id="<?php echo $row['product_id'] ?>"
									data-price="<?php echo $row['cart_price'] ?>"
									data-stock="<?php echo $row['stock'] ?>"
									data-cart_id="<?php echo $row['cart_id'] ?>"
									>
										<i class="fa fa-minus"></i>
									</button>
								</div>
								<input type="number" id="qut_change"  name="qut_change" min="1" max="5" class="form-control form-control-sm bg-secondary border-0 text-center qut_change" value="<?php echo $row['cart_qty'] ?>">
								<div class="input-group-btn">
									<button class="btn btn-sm btn-primary btn-plus link2"  id="btn_plus" 
									data-product_id="<?php echo $row['product_id'] ?>"
									data-price="<?php echo $row['cart_price'] ?>"
									data-stock="<?php echo $row['stock'] ?>"
									data-cart_id="<?php echo $row['cart_id'] ?>"
									>
										<i class="fa fa-plus"></i>
									</button>
								</div>
							</div>
						</td>
					
						
						<input type="hidden" id="price" name="price" value="<?php echo $row['cart_price'] ?>">
						<input type="hidden" id="product_id" name="product_id" value="<?php echo $row['product_id'] ?>">
						<input type="hidden" id="stock" name="stock" value="<?php echo $row['stock'] ?>">
					   <td class="align-middle" ><button class="btn btn-sm btn-danger" onclick="delete_cart_items(<?php echo $row['cart_id'] ?>)"><i class="fa fa-times"></i></button></td>
                    </tr>
					
		<?php	}
						}
					?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Amount</h6>
                        <h6 class="font-weight-medium total_amount" id="amount"><?php echo $total_amount ?></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 class="font-weight-medium all_amount" id="all_amount" ><?php echo $total_amount ?></h5>
						<input type="hidden" id="total_price" name="total_price" value="<?php echo $total_amount ?>">
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
$(document).ready(function() {
    var totalAmount = parseInt($('#total_price').val());
    $('.btn-minus').click(function() {
		try{
			var price = parseInt($(this).data('price'));
			var product_id = parseInt($(this).data('product_id'));
			var cart_id = parseInt($(this).data('cart_id'));
			var qut = parseInt($(this).closest('tr').find('.qut_change').val());
			if (qut == 0) {
				alert("Plase Add Stock: ");
				totalAmount -= price;
					$.ajax({
						type: "POST",
						url: "functions/function_ajax.php",
						data: {
							action: "add_to_cart_delete",
							cart_id: cart_id
						},
						// specify the expected data type of the response
						success: function(response) {
								var resp = JSON.parse(response);
							if (resp.status) {
								window.location.href = "cart.php";
							} else {
								alert("Error: " + response.message); // Assuming there's a message field in the response
							}
						},
						error: function(xhr, status, error) {
							// Function to be called if the request fails
							console.error("Error loading data: " + error);
						}
					});
				//var btn_plus = document.getElementById("btn_minus");
				// Disable the button
				//btn_plus.style.pointerEvents = "none";
				
				 
			} else {
				
				var btn_plus = document.getElementById("btn_plus");
				console.log(btn_plus);
				// Disable the button
				btn_plus.style.pointerEvents = "auto";
				
				 totalAmount -= price;
			}
		   

			updateTotal(totalAmount);
		}catch (error) {
			console.error("Error occurred:", error);
		}
    });

    $('.btn-plus').click(function() {
		try{
			 var price = parseInt($(this).data('price'));
			var qut = parseInt($(this).closest('tr').find('.qut_change').val());
			var stock = parseInt($(this).data('stock'));
			var cart_id = parseInt($(this).data('cart_id'));
			var product_id = parseInt($(this).data('product_id'));
			
			if (qut >= stock) {
				 alert("Only Available Stock: " + stock);
				 $(this).css('pointer-events', 'none'); 
				totalAmount += price;
			} else {
				var btn_plus = document.getElementById("btn_minus");
				// Disable the button
				btn_plus.style.pointerEvents = "auto";
				
				totalAmount += price;
			}

			updateTotal(totalAmount);
		}
		catch (error) {
			console.error("Error occurred:", error);
		}
       
    });

    function updateTotal(amount) {
        $('#all_amount').text(amount);
        $('#amount').text(amount);
        $('#total_amount_p').text(amount);
    }
});
function delete_cart_items(cart_id)
{
	try{
		
		var cart_id = cart_id;
		$.ajax({
			type: "POST",
			url: "functions/function_ajax.php",
			data: {
				action: "add_to_cart_delete",
				cart_id: cart_id
			},
			// specify the expected data type of the response
			success: function(response) {
					var resp = JSON.parse(response);
				if (resp.status) {
					window.location.href = "cart.php";
				} else {
					alert("Error: " + response.message); // Assuming there's a message field in the response
				}
			},
			error: function(xhr, status, error) {
				// Function to be called if the request fails
				console.error("Error loading data: " + error);
			}
		});
	}catch (error) {
		console.error("Error occurred:", error);
	}
}

function checkout()
{
	window.location.href = "checkout.php";
	
}
</script>
</body>
</html>