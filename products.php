<?php
	include('inc/header.php');
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Product</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php 
					$getproductall=$product->get_product();
					if($getproductall){
						while($resultproductall=$getproductall->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4" style="margin-left:0">
					 <a href="details.php?proid=<?php echo $resultproductall['productId']?>"><img src="admin/uploads/<?php echo $resultproductall['image'] ?>"  alt="" /></a>
					 <h2><?php echo $resultproductall['productName']?></h2>
					 <p><span class="price"><?php echo number_format($resultproductall['price'])?> VNĐ</span></p>
				    
				     <div class="button"><span><a href="details.php?proid=<?php echo $resultproductall['productId']?>" class="details">Xem chi tiết</a></span></div>
				</div>
				<?php
						}
					}
				?>
			</div>
			
    	</div>
			
    </div>
	<div>
		<?php
			$product_all=$product->get_all_product();
			$product_count=mysqli_num_rows($product_all);
			$product_buttons=ceil($product_count/4);
			$i=1;
			echo '<p>Trang</p>';
			for($i=1;$i<=$product_buttons; $i++){
				echo '<a style="margin:0px 10px;" href="products.php?trang='.$i.'">'.$i.' </a>';
			}

		?>
	</div>
 </div>
 
<?php 
	include_once('inc/footer.php');
?>
