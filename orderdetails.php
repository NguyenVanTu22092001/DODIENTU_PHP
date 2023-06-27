<?php
include('inc/header.php')
?>
<?php
/* if(isset($_GET['cartid'])){
        $cartid=$_GET['cartid'];
		$delcart=$ct->delete_cart($cartid);
    }
	if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
		$cartId=$_POST['cartId'];
		$quantity=$_POST['quantity'];
		$update_quantity_cart=$ct->update_quantity_cart($quantity, $cartId); 
		if($quantity<=0){
			$delcart=$ct->delete_cart($cartId);
		}
	} */

$customerid = Session::get('customer_id');

$login_check = Session::get('customer_login');
if ($login_check == false) {
	header('location: login.php');
}
$get_orderdetails = $ct->getAmountPrice($customerid);

if (isset($_GET['confirmid'])) {
	$id = $_GET['confirmid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$shifted_confirm = $ct->shifted_confirm($id, $price, $time);
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
				<h2>OrderDetails</h2>

				<table class="tblone">
					<tr>
						<th>Thứ tự</th>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>

						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="20%">Date</th>
						<th width="20%">Status</th>
						<th width="10%">Action</th>
					</tr>
					<?php


					?>
					<?php
					$get_product_cart = $ct->get_product_cart($customerid);
					$total = 0;
					$qty = 0;
					if (($get_orderdetails)) {
						$i = 0;
						while ($result = $get_orderdetails->fetch_assoc()) {
							$i++;
							$subtotal = $result['quantity'] * $result['price'];
							$total += $subtotal;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" height="40px" width="60px"></td>



								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo number_format($result['price']) ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td><?php
									if ($result['status'] == 0) {
										echo 'Pending';
									} elseif ($result['status'] == 1) {
									?>
										<span>Shifted</span>

									<?php
									} else {
										echo 'Received';
									}
									?>
								</td>
								<?php
								if ($result['status'] == 0) {
								?>
									<td><a>N/A</a></td>
								<?php
								} elseif ($result['status'] == 1) {
								?>
									<td><a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Confirmed</a></td>
								<?php

								} else {
								?>
									<td>Received</a>
									<?php
								}
									?>
							</tr>
					<?php
							$qty += $result['quantity'];
						}
					}
					?>
				</table>

			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php')
?>