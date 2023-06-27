<?php
	include('inc/header.php');
?>
<?php
	$login_check=Session::get('customer_login');
    if($login_check==false){
        header('location: login.php');
    }
?>
 <div class="main">
  
    	<div class="content_top">
    		<div class="heading">
    	        <h3>Your Profile</h3>
    	    </div>
    	<div class="clear"></div>
    </div>
    <div class="content">
    	<div class="section group">
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
                    <td colspan="3"><a href="profileedit.php">Update Profile</a></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
	    </div>
	</div>
			
	<?php
		include('inc/footer.php');
	?>	
