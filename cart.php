<?php
include('inc/header.php')
?>
<?php
$customerid = Session::get('customer_id');

$login_check = Session::get('customer_login');
if (isset($_GET['cartid'])) {
	$cartid = $_GET['cartid'];
	$delcart = $ct->delete_cart($cartid);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
	if ($quantity <= 0) {
		$delcart = $ct->delete_cart($cartId);
	}
}
?>
<?php
/* if(!isset($_GET['cartid'])){
		echo "<meta http-equiv='refresh' content='0; URL?id=live'>";
	} */
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<?php
				if (isset($update_quantity_cart)) {
					echo $update_quantity_cart;
				}
				if (isset($delcart)) {
					echo $delcart;
				}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$get_product_cart = $ct->get_product_cart();
					$total = 0;
					$qty = 0;
					if ($get_product_cart) {
						while ($result = $get_product_cart->fetch_assoc()) {
							$subtotal = $result['quantity'] * $result['price'];
							$total += $subtotal;
					?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" height="40px" width="60px" alt="" /></td>
								<td><?php echo number_format($result['price']) ?></td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php echo number_format($result['quantity'] * $result['price']) ?></td>
								<td><a href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
							</tr>
					<?php
							$qty += $result['quantity'];
						}
					}
					?>
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td><?php

							echo number_format($total);
							Session::set('sum', $total);
							Session::set('qty', $qty);
							?></td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>10%</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td>
							<?php
							$total *= 1.1;
							echo number_format($total)
							?>

						</td>
					</tr>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php')
?>