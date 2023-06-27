<?php
	include('inc/header.php')
?>
<?php
	if(isset($_GET['cartid'])){
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
	}
	$customerid=Session::get('customer_id');
		
	$login_check=Session::get('customer_login');
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
			    	<h2>CompareProduct</h2>
					<?php
					/* if(isset($update_quantity_cart)){
						echo $update_quantity_cart;
					}
					if(isset($delcart)){
						echo $delcart;
					} */
					?>
						<table class="tblone">
							<tr>
								<th width="10%">Compare ID</th>
								<th width="20%">Product Name</th>
								<th width="25%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Action</th>
							
							</tr>
							<?php 
								$get_compare= $product->get_compare($customer_id);
								$i=0;
								if($get_compare){
									while($result=$get_compare->fetch_assoc()){
										$i++;
										
							?>
							<tr>
								<td><?php echo $i?></td>
								
								<td><?php echo ($result['productName'])?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" height="40px" width="60px" alt=""/></td>
								<td><?php echo number_format($result['price'])?></td>
								<td><a onclick="return confirm('Do you want to delete?')" href="details.php?proid=<?php echo $result['productId']?>">View</a></td>
							</tr>
							<?php
							
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