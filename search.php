<?php
	include('inc/header.php')
?>
<?php
    /* if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
        echo"<script>window.location='404.php'</script>";
    }else{
        $id=$_GET['catId'];
    } */
    if($_SERVER['REQUEST_METHOD']=='POST'){
		$tukhoa=$_POST['tukhoa'];
        $search_product=$product->search_product($tukhoa);
	}
	
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
				
    			<h3>Tìm kiếm: <?php echo $tukhoa?></h3>
				
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php
					
					if($search_product){ 
						while($resultproductbycat=$search_product->fetch_assoc()){
				?>

		  		<div class="grid_1_of_4 images_1_of_4" style="margin-left:0">
					 <a href="details.php?proid=<?php echo $resultproductbycat['productId']?>"><img src="admin/uploads/<?php echo $resultproductbycat['image'] ?>"  alt="" /></a>
					 <h2><?php echo $resultproductbycat['productName']?></h2>
					 <p><span class="price"><?php echo number_format($resultproductbycat['price'])?> VNĐ</span></p>
				    
				     <div class="button"><span><a href="details.php?proid=<?php echo $resultproductbycat['productId']?>" class="details">Xem chi tiết</a></span></div>
				</div>
				<?php
						}
						
					}else{
						echo "No product";
					}
				?>
				
			</div>

	
	
    </div>
 </div>
<?php
	include('inc/footer.php');
?>
