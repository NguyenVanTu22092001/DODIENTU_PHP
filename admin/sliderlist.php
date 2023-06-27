<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php'?>
<?php 
	$product=new product();
	if(isset($_GET['delslider'])){
		$delid=$_GET['delslider'];
		$del_slider=$product->del_slider($delid);
	}
	if(isset($_GET['sliderId'])){
		$id=$_GET['sliderId'];
		$type=$_GET['type'];
		$update_type_slider=$product->update_type_slider($id, $type);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
			<?php
				if(isset($del_slider)){
					echo $del_slider;
				}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Name</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$product=new product();
					$get_slider=$product->get_slider();
					$i=0;
					if($get_slider){
						while($result_slider=$get_slider->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result_slider['sliderName']?></td>
					<td><img src="uploads/<?php echo $result_slider['image']?>" height="80px" width="120px"/></td>	
					<td>
						<?php
							if($result_slider['type'] == 0){
							?>
							<a href="?sliderId=<?php echo $result_slider['sliderId']?>&type=1">Off</a>
							<?php 
							}	
							else{
							?>
							<a href="?sliderId=<?php echo $result_slider['sliderId']?>&type=0">On</a>
							<?php
							}

						?>
					</td>			
					<td>
						<a onclick="return confirm('Do you want to delete ?')" href="?delslider=<?php echo $result_slider['sliderId']?>">Delete</a></td>
					</td>
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
