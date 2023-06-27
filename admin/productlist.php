<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once('../classes/product.php')?>
<?php include_once('../classes/brand.php')?>
<?php include_once('../classes/category.php')?>
<?php include_once('../helpers/format.php');?>
<?php
	$product = new product();
	$fm= new Format();

	if(isset($_GET['productid'])){
        $id=$_GET['productid'];
		$delpro=$product->delete_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Price</th>
					<th>Image</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				$productlist=$product->show_product();
				if($productlist){
					$i=0;
					while($result=$productlist->fetch_assoc()){
						$i++;
					
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['catName']?></td>
					<td><?php echo $result['brandName']?></td>
					<td><?php echo number_format($result['price'])?></td>
					<td><img src="uploads/<?php echo $result['image']?>" style="width:100px;display: block;margin-right: auto;margin-left: auto;"></td>
					<td><?php echo $result['product_desc']?></td>
					<td class="center">
						<?php 
							if($result['type']==1){
								echo 'Featured';
							}
							else{
								echo 'Non-Featured';
							}
						?>
					</td>
					<td><a href="productedit.php?productid=<?php echo $result['productId']?>">Edit</a> || <a href="?productid=<?php echo $result['productId']?>">Delete</a></td>
				</tr>
				<?php
					}
				}
				?>	
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
