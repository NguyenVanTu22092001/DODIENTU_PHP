<?php
include('inc/header.php');
?>
<?php


?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == true) {
	header('location: index.php');
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$insertCustomers = $cs->insert_customers($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$loginCustomers = $cs->login_customers($_POST);
}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<?php
			if (isset($loginCustomers)) {
				echo $loginCustomers;
			}
			?>
			<form action="" method="POST">
				<input name="email" type="text" value="Name" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
				<input name="password" type="password" value="Password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">

				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
				<div class="buttons">
					<div><input type="submit" class="buttons" value="Sign in" name="login"></div>
				</div>
			</form>
		</div>
		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($insertCustomers)) {
				echo $insertCustomers;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" value="" name="name" placeholder="Enter Name">
								</div>

								<div>
									<input type="text" value="" name="city" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'City';}">
								</div>

								<div>
									<input type="text" value="Zip-Code" name="zipcode" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Zip-Code';}">
								</div>
								<div>
									<input type="text" value="E-Mail" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}">
								</div>
							</td>
							<td>
								<div>
									<input type="text" value="Address" name="address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Address';}">
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required" style="width:100%">
										<option value="null">Select a Country</option>
										<option value="null">Hà Nội</option>
										<option value="null">Nam Định</option>
									</select>
								</div>

								<div>
									<input type="text" value="Phone" name="phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}">
								</div>

								<div>
									<input type="text" value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" class="grey" value="Creat Account" name="submit"></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include('inc/footer.php');
?>