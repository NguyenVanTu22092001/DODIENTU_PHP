<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$filepath=realpath(dirname(__FILE__));
	include_once($filepath.'/../classes/cart.php');
	include_once($filepath.'/../helpers/format.php');
    include_once($filepath.'/../classes/customer.php');
?>
<?php
    $cs=new customer();  
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL){
        echo"<script>window.location='inbox.php'</script>";
    }else{
        $id=$_GET['customerid'];
    }
    /* if($_SERVER['REQUEST_METHOD']=='POST'){
		$catName=$_POST['catName'];
		$updateCat=$cat->update_category($catName, $id);
	} */
	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chỉnh sửa danh mục mới</h2> 
               <div class="block copyblock"> 
                    
                    <?php
                        $get_customer=$cs->show_customers($id);
                        if($get_customer){
                            while($result=$get_customer->fetch_assoc()){ 
                    ?>
                    <form action="" method="POST">
                        <table class="form">					
                            <tr>
                                <td>Name:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="name" value="<?php echo $result['name'] ?>" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="address" value="<?php echo $result['address'] ?>, <?php echo $result['city']?>, <?php echo $result['country']?>" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Zipcode:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="zipcode" value="<?php echo $result['zipcode'] ?>" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="phone" value="<?php echo $result['phone'] ?>" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>
                                    <input type="text" readonly="readonly" name="email" value="<?php echo $result['email'] ?>" class="medium">
                                </td>
                            </tr>
                            <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>