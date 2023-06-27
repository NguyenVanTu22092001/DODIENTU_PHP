<?php
	include('inc/header.php');
?>
<?php
	if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
		$customer_id=Session::get('customer_id');
		
		$insertOrder=$ct->insert_Order($customer_id);
		$delCart=$ct->delete_all_data_cart();	
		header('location: success.php');
	}
?>
<style>
    .box_left{
        width:50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }
    .box_right{
        width:45%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }
</style>
 <div class="main">
    	<div class="content_top">
    		<div class="heading">
    	        <h3>Offline Payment</h3>
    	    </div>
    		<div class="clear"></div>
    	</div>
	<form action="" method="POST">
    <div class="content">
    	<div class="section group">
			<div class="box_left">
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
					if(isset($update_quantity_cart)){
						echo $update_quantity_cart;
					}
					if(isset($delcart)){
						echo $delcart;
					}
					?>
						<table class="tblone">
							<tr>
								<th width="10%">Thự tư</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
						
							</tr>
							<?php 
								$get_product_cart= $ct->get_product_cart();
								$total=0;
								$qty=0;
								$tt=0;
								if($get_product_cart){
									while($result=$get_product_cart->fetch_assoc()){
										$tt++;
										$subtotal=$result['quantity'] *$result['price'];
										$total+=$subtotal;
							?>
							<tr><td><?php echo $tt?></td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td><?php echo number_format($result['price'])?></td>
								<td><?php echo $result['quantity']?>
							
								</td>
								<td><?php echo number_format($result['quantity'] *$result['price'])?></td>
				
							</tr>
							<?php
									$qty+=$result['quantity'];
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
										$total*=1.1;
										echo number_format($total)
									?>

								</td>
							</tr>
					   </table>
					</div>
					
            </div>
			<br>
            <div class="box_right">
				<table class="tblone">
					<?php 
						$id=Session::get('customer_id');
						$get_customers=$cs->show_customers($id);
						if($get_customers){
							while($result=$get_customers->fetch_assoc()){
					?>
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><?php echo $result['name']?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $result['address']?></td>
					</tr>
					<tr>
						<td>City</td>
						<td>:</td>
						<td><?php echo $result['city']?></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><?php echo $result['country']?></td>
					</tr>
					<tr>
						<td>Zipcode</td>
						<td>:</td>
						<td><?php echo $result['zipcode']?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $result['phone']?></td>
					</tr>
					
					<tr>    
						<td colspan="3"><a href="profileedit.php">Update</a></td>
					</tr>
					<?php
							}
						}
					?>
				</table>
			</div>
			
	    </div>
		<br>
		<a href="?orderid=order" style="background: red; padding: 7px 20px; color:#fff; font-size: 20px;margin: 20px;">Order Now</a>
		
		</form>
	</div>
			
	<?php
		include('inc/footer.php');
	?>	
