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

    <div class="content">
    	<div class="section group">
            <h2 style="text-align:center; color: red">Success Order</h2>
            <?php
                $customer_id=Session::get('customer_id');
                $get_amount=$ct->getAmountPrice($customer_id);
                if($get_amount){
                    $amount=0;
                    while($result=$get_amount->fetch_assoc()){
                        $price=$result['price'];
                        $amount+=$price;
                    }
                }
            ?>
            
            <p style="text-align:center; padding:10px; font-size: 20px;">We will contact as soon as possiable. Please see your order detail here <a href="orderdetails.php">Click here</a></p>
            
	    </div>
	</div>
			
	<?php
		include('inc/footer.php');
	?>	
