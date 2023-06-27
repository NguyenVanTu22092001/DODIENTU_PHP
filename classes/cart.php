<?php
    $filepath=realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
    class cart
    {   
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function add_to_cart($quantity, $id){
            $customerid=Session::get('customer_id');
            $quantity=$this->fm->validation($quantity);
            $quantity=mysqli_real_escape_string($this->db->link, $quantity);
            $id=mysqli_real_escape_string($this->db->link, $id);
            $sId=session_id();
            $query="SELECT *FROM tbl_product WHERE productId='$id'";
            $result=$this->db->select($query)->fetch_assoc();
            $image= $result['image'];
            $price=$result['price'];
            $productName=$result['productName'];
            $query_cart="SELECT *FROM tbl_cart WHERE productId='$id' AND sId='$sId'";
            $check_cart =  $this->db->select($query_cart); 
            if($check_cart){
                $msg="Added";
                return $msg;
            }
            else{
                $query_insert ="INSERT INTO tbl_cart(productId, quantity, sId, image, price, productName, customerId) VALUES('$id', '$quantity', '$sId', '$image', '$price','$productName','$customerid' )";
                $insert_cart=$this->db->update($query_insert);
                
                if($result){
                    header('location: cart.php');
                }else{
                    header('location: 404.php');
                }
            }
        }
        public function get_product_cart(){
            $customerid=Session::get('customer_id');
            $sId=session_id();
            $query="SELECT * FROM tbl_cart WHERE sId='$sId' AND customerId='$customerid'";
            $result=$this->db->select($query);
            return $result;
        }
        public function update_quantity_cart($quantity, $cartId){
            $query_update_quantity="UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId='$cartId'";
            $result=$this->db->update($query_update_quantity);
            if($result){
                header('location: cart.php');
            }else{
                $msg="<span>product quantity updated Not succesfully</span>";
                return $msg;
            }
        }
        public function delete_cart($cartid){
            $cartid=mysqli_real_escape_string($this->db->link, $cartid);
            $query ="DELETE FROM tbl_cart WHERE cartId='$cartid'";
            $result=$this->db->delete($query);
            if($result){
                header('location:cart.php');
                
            }else{
                $alert = "<span class='error'>Not Success</span>";
                return $alert;
            }
        }
        public function check_cart(){
            $sId=session_id();
            $query="SELECT * FROM tbl_cart WHERE sId='$sId'";
            $result=$this->db->select($query);
            return $result;
        }
        public function getLastestIphone(){
            $query="SELECT *FROM tbl_product, tbl_brand WHERE tbl_product.brandId='4' AND tbl_brand.brandId='4' ORDER BY productId DESC LIMIT 1 ";
            $result=$this->db->select($query);
            return $result;
        }
        public function getLastestSamSung(){
            $query="SELECT *FROM tbl_product, tbl_brand WHERE tbl_product.brandId='3' AND tbl_brand.brandId='3' ORDER BY productId DESC LIMIT 1 ";
            $result=$this->db->select($query);
            return $result;
        }
        public function getLastestXiaomi(){
            $query="SELECT *FROM tbl_product, tbl_brand WHERE tbl_product.brandId='7' AND tbl_brand.brandId='7'  ORDER BY productId DESC LIMIT 1 ";
            $result=$this->db->select($query);
            return $result;
        }
        public function getLastestHuawei(){
            $query="SELECT *FROM tbl_product, tbl_brand WHERE tbl_product.brandId='6' AND tbl_brand.brandId='6' ORDER BY productId DESC LIMIT 1 ";
            $result=$this->db->select($query);
            return $result;
        }
        public function delete_all_data_cart(){
            $sId=session_id();
            $query="DELETE FROM tbl_cart WHERE sId='$sId'";
            $result=$this->db->delete($query);
            return $result;
        }
        public function insert_Order($customer_id){
            $sId= session_id();
            $query="SELECT * FROM tbl_cart WHERE sId='$sId'";
            $result_cart=$this->db->select($query);
            if($result_cart){
                while($result=$result_cart->fetch_assoc()){
                    $productId=$result['productId'];
                    $productName=$result['productName'];
                    $customerId= $customer_id;
                    $quantity=$result['quantity'];
                    $price=$result['price'] * $quantity;
                    $image=$result['image'];
                    $query_order="INSERT INTO tbl_order(productId, productName, customerId, quantity, price, image) VALUES('$productId',  '$productName', '$customerId', '$quantity', '$price', '$image')";
                    $result_order=$this->db->insert($query_order); 
                }
                
            }
        }
        public function getAmountPrice($customer_id){

            $query="SELECT * FROM tbl_order WHERE customerId ='$customer_id'";
            $result=$this->db->select($query);
            return $result;
        }
        public function get_inbox_cart(){
            $query_inbox_cart="SELECT * FROM tbl_order ORDER BY date_order";
            $result_inbox_cart=$this->db->select($query_inbox_cart);
            return $result_inbox_cart;
        }
        public function shifted($id, $price, $time){
            $id=mysqli_real_escape_string($this->db->link, $id);
            $price=mysqli_real_escape_string($this->db->link, $price);
            $time=mysqli_real_escape_string($this->db->link, $time);
            $query="UPDATE tbl_order SET status='1' WHERE id='$id' AND date_order='$time' AND price='$price'";
            $result=$this->db->update($query);
            if($result){
                $msg="<span class='success'>Success</span>";
                return $msg;
            }else{
                $msg="<span class='error'>Not Success</span>";
                return $msg;
            }
        }
        public function del_shifted($id, $price, $time){
            $id=mysqli_real_escape_string($this->db->link, $id);
            $price=mysqli_real_escape_string($this->db->link, $price);
            $time=mysqli_real_escape_string($this->db->link, $time);
            $query="DELETE FROM tbl_order WHERE id='$id' AND date_order='$time' AND price='$price'";
            $result=$this->db->delete($query);
            if($result){
                $msg="<span class='success'>Success</span>";
                return $msg;
            }else{
                $msg="<span class='error'>Not Success</span>";
                return $msg;
            }
        }
        public function shifted_confirm($id, $price, $time){
            $id=mysqli_real_escape_string($this->db->link, $id);
            $price=mysqli_real_escape_string($this->db->link, $price);
            $time=mysqli_real_escape_string($this->db->link, $time);
            $query="UPDATE tbl_order SET status='2' WHERE customerId='$id' AND date_order='$time' AND price='$price'";
            $result=$this->db->update($query);
           
            return $result;
               
        }
    }
    
?>