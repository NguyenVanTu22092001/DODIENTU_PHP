<?php
	include('inc/header.php');
?>
<?php
	if(!isset($_GET['proid']) ||$_GET['proid'] ==NULL){
		echo "<script>window.location='404.php'</cript>";
	}else{
		$id=$_GET['proid'];	
	}
	if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
		$quantity=$_POST['quantity'];
		$AddtoCart=$ct->add_to_cart($quantity, $id);
	}
	$customer_id=Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['compare'])){
		$productid=$_POST['productid'];
		$insertCompare=$product->insert_Compare($productid, $customer_id);
	}
	if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['wishlist'])){
		$productid=$_POST['productid'];
		$insertWishlist=$product->insert_Wishlist($productid, $customer_id);
	}
	if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['comment_submit'])){
		$id=$_GET['proid'];
		$insertComment=$cs->insert_comment($id);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php 
				$get_product_details=$product->get_details($id);
				if($get_product_details){
					while($result_details=$get_product_details->fetch_assoc()){	
			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName']?></h2>
								
					<div class="price">
						<p>Price: <span><?php echo number_format($result_details['price'])?> VNĐ</span></p>
						<p>Category: <span><?php echo $result_details['catName']?></span></p>
						<p>Brand:<span><?php echo $result_details['brandName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Add to cart	"/>
						
					</form>		
					<?php
						if(isset($AddtoCart)){
							echo '<span>Added</span>';
							}
						?>		
				</div>

				<div class="add-cart">
					<form action="" method="POST">
						<!-- <a href="?wlist=<?php echo $result_details['productId']?>" class="buysubmit" >Save to Wishlist</a>
						<a class="buysubmit" href="?compare=<?php echo $result_details['productId']?>">Compare Product</a>	 -->
						<input type="hidden"  name="productid" value="<?php echo $result_details['productId']?>">
						<?php 
						$login_check=Session::get('customer_login');
						if($login_check==false){
							echo '';
						}else{	
							echo'<input type="submit" class="buysubmit" name="compare" value="Compare Product">'.' ';
					
						}
						?>
						<?php
						if(isset($insertCompare)){
							echo $insertCompare;
						}
					?>
					</form>
					<br>
					<form action="" method="POST">
						<!-- <a href="?wlist=<?php echo $result_details['productId']?>" class="buysubmit" >Save to Wishlist</a>
						<a class="buysubmit" href="?compare=<?php echo $result_details['productId']?>">Compare Product</a>	 -->
						<input type="hidden"  name="productid" value="<?php echo $result_details['productId']?>">
						<?php 
						$login_check=Session::get('customer_login');
						if($login_check==false){
							echo '';
						}else{	
						
							echo'<input type="submit" class="buysubmit" name="wishlist" value="Save to Wishlist">';
						}
						?>
						<?php
						if(isset($insertWishlist)){
							echo $insertWishlist;
						}
					?>
					</form>
					
				</div>

			</div>
			<div class="product-desc">
				<h2>Product Details</h2>
				<p><?php echo $result_details['product_desc']?></p>
			</div>
		<?php
				}
			}
		?>
		<div class="binhluan">
			<div class="row">
				<div class="col-md-12">
					<div class="product-desc">
						<h2>Ý kiến khách hàng</h2>		
					</div>
				</div>
				<div class="col-md-12">
					<form action="" method="POST">
						<p><input type="text" placeholder="Điền tên" class="form-control" name="commentName"></p>
						<p><textarea rows="6" placeholder="Bình luận..." class="form-control" name="detail"></textarea></p>
						<p><input type="submit" name="comment_submit" class="btn btn-success" Value="Gửi bình luận"></p>
						<?php
							if(isset($insertComment)){
								echo $insertComment;
							}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="rightsidebar span_3_of_1">
		<h2>CATEGORIES</h2>
		<ul>
			<?php 
				$getall_category=$cat->show_category();
				if($getall_category){
					while($result_allcat=$getall_category->fetch_assoc()){
			?>
				<li><a href="productbycat.php?catId=<?php echo $result_allcat['catId']?>"><?php echo $result_allcat['catName'] ?></a></li>
			<?php
					}
				}
			?>
    	</ul>
    	
 	</div>
 	</div>
 	</div>

	<?php
		include('inc/footer.php');
	?>	
