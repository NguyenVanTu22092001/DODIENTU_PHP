<?php
include('lib/session.php');
session::init();
?>
<?php
include_once('lib/database.php');
include_once('helpers/format.php');
spl_autoload_register(function ($className) {
	include_once "classes/" . $className . ".php";
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$cat = new category();
$us = new user();
$cs = new customer();
$product = new product();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>

<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="POST">
						<input type="text" name="tukhoa" placeholder="Tìm kiếm sản phẩm"><input type="submit" name="search_product" value="Tìm kiếm">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product">
								<?php
								$check_cart = $ct->check_cart();
								if ($check_cart) {
									$sum = Session::get('sum');
									$quantity = Session::get('qty');
									if ($quantity <= 1) {
										echo $quantity . " product";
									} else {
										echo $quantity . " products";
									}
								}
								?>
							</span>
						</a>
					</div>
				</div>
				<?php
				if (isset($_GET['customerid'])) {
					$delCart = $ct->delete_all_data_cart();
					Session::destroy();
				}
				?>
				<div class="login">
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '<a href="login.php">Login</a></div>';
					} else {
						echo '<a href="?customerid=' . Session::get("customer_id") . '">Logout</a></div>';
					}
					?>


					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="menu">
				<ul id="dc_mega-menu-orange" class="dc_mm-orange">
					<li><a href="index.php">Home</a></li>
					<li><a href="products.php">Products</a> </li>
					<!-- <li><a href="topbrands.php">Top Brands</a></li> -->

					<li><a href="cart.php">Cart</a></li>


					<li><a href="contact.php">Contact</a> </li>
					<?php
					$customer_id = Session::get('customer_id');

					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '';
					} else {
						// echo '<li><a href="compare.php">Compare</a> </li>';
					}
					?>
					<?php

					$customer_id = Session::get('customer_id');

					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '';
					} else {
						echo '<li><a href="wishlist.php">Wishlist</a></li>';
					}
					?>
					<?php

					$customer_id = Session::get('customer_id');

					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '';
					} else {
						echo '<li><a href="profile.php">Profile</a> </li>';
					}
					?>
					<?php
					$customer_id = Session::get('customer_id');

					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo '';
					} else {
						echo '<li><a href="orderdetails.php">Order</a></li>';
					}
					?>


					<div class="clear"></div>
				</ul>
			</div>