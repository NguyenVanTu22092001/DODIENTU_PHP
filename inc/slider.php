<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastestIphone=$ct->getLastestIphone();
					if($getLastestIphone){
						while($result_iphone=$getLastestIphone->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_iphone['productId']?>"> <img src="admin/uploads/<?php echo $result_iphone['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_iphone['brandName']?></h2>
						<p><?php echo $result_iphone['productName']?></p>
						<p><?php echo number_format($result_iphone['price'])?> VNĐ</p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_iphone['productId']?>">Detail</a></span></div>
				   </div>
			   </div>	
				<?php
					}		
				}
				?>
				
				<?php
					$getLastestIphone=$ct->getLastestSamSung();
					if($getLastestIphone){
						while($result_iphone=$getLastestIphone->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_iphone['productId']?>"> <img src="admin/uploads/<?php echo $result_iphone['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_iphone['brandName']?></h2>
						<p><?php echo $result_iphone['productName']?></p>
						<p><?php echo number_format($result_iphone['price'])?> VNĐ</p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_iphone['productId']?>">Detail</a></span></div>
				   </div>
			   </div>	
				<?php
					}		
				}
				?>
		
			</div>
			<div class="section group">

			<?php
					$getLastestIphone=$ct->getLastestXiaomi();
					if($getLastestIphone){
						while($result_iphone=$getLastestIphone->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_iphone['productId']?>"> <img src="admin/uploads/<?php echo $result_iphone['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_iphone['brandName']?></h2>
						<p><?php echo $result_iphone['productName']?></p>
						<p><?php echo number_format($result_iphone['price'])?> VNĐ</p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_iphone['productId']?>">Detail</a></span></div>
				   </div>
			   </div>	
				<?php
					}		
				}
				?>

				<?php
					$getLastestIphone=$ct->getLastestHuawei();
					if($getLastestIphone){
						while($result_iphone=$getLastestIphone->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result_iphone['productId']?>"> <img src="admin/uploads/<?php echo $result_iphone['image']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2><?php echo $result_iphone['brandName']?></h2>
						<p><?php echo $result_iphone['productName']?></p>
						<p><?php echo number_format($result_iphone['price'])?> VNĐ</p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result_iphone['productId']?>">Detail</a></span></div>
				   </div>
			   </div>	
				<?php
					}		
				}
				?>

			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
							$get_slider=$product->get_slider_active();
							if($get_slider){
								while($result_slider=$get_slider->fetch_assoc()){
						?>
						<li><img src="admin/uploads/<?php echo $result_slider['image']?>" alt="<?php echo $result_slider['sliderName']?>"/></li>
						<?php
								}
							}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>