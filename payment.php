<?php
	include('inc/header.php');
?>
<?php
	$login_check=Session::get('customer_login');
    if($login_check==false){
        header('location: login.php');
    }
?>
<style>
	h3.payment{
		text-align: center;
		font-size:20px;
		font-weight: bold;
		text-decoration: underline;
	}
	.wrapper_method{
		text-align:center;
		width: 550px;
		margin: 0 auto;
		border:1px solid #666;
		padding: 20px;
		background: consilk;
	}
	.wrapper_method a{
		padding: 5px;
		background: red;
		color: #fff;
	}
	.wrapper_method h3{
		margin-bottom:20px;
	}
</style>
 <div class="main">
    	<div class="content_top">
    		<div class="heading">
    	        <h3>Payment</h3>
    	    </div>
    	<div class="clear"></div>
    </div>
    <div class="content">
    	<div class="section group">
			<div class="wrapper_method">
				<h3 class="payment">Choose your method payment</h3>
				<a href="offlinepayment.php">Offline Payment</a>
				<a href="onlinepayment.php">Online Payment</a>
			</div>
	    </div>
	</div>
			
	<?php
		include('inc/footer.php');
	?>	
