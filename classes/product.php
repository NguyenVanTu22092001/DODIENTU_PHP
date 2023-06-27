<?php
    $filepath=realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
    class product
    {   
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function  insert_product($data, $files)
        {
            $productName=mysqli_real_escape_string($this->db->link, $data['productName']);
            $category=mysqli_real_escape_string($this->db->link, $data['category']);
            $brand=mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc=mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price=mysqli_real_escape_string($this->db->link, $data['price']);
            $type=mysqli_real_escape_string($this->db->link, $data['type']);
            $permited=array('jpg', 'jpeg', 'png', 'gif');   
            $file_name=$_FILES['image']['name'];
            $file_size=$_FILES['image']['size'];
            $file_temp=$_FILES['image']['tmp_name'];

            $div=explode('.', $file_name);
            $file_ext=strtolower(end($div));
            $unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image="uploads/".$unique_image;
            if($productName=="" || $category=="" || $brand==""||$product_desc==""||$price==""||$type==""||$file_name==""){
                $alert = "<span class='error'>Fiels must be not empty</span>";
                return $alert;
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query ="INSERT INTO tbl_product(productName, catId, brandId, product_desc, type, price, image) values('$productName', '$category', '$brand', '$product_desc', '$type', '$price', '$unique_image')";
                $result=$this->db->insert($query); 
                if($result){
                    $alert = "<span class='success'>Success</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Not Success</span>";
                    return $alert;
                }
            }
        }
        public function  show_product()
        {
            $query ="SELECT  tbl_product .*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId=tbl_category.catId 
            INNER JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandId ORDER BY tbl_product.productId ASC ";
            $result=$this->db->select($query);
            return $result;
        }
        public function get_product(){
            if(!isset($_GET['trang'])){
                $trang=1;
            }else{
                $trang=$_GET['trang'];
            }
            $sp_tungtrang=4;
            $tung_trang=($trang - 1)*$sp_tungtrang;
            $query ="SELECT * FROM tbl_product ORDER BY productId ASC LIMIT $tung_trang, $sp_tungtrang   ";
            $result=$this->db->select($query);
            return $result;
        }

        public function  get_all_product(){
            
            $query ="SELECT * FROM tbl_product";
            $result=$this->db->select($query);
            return $result;
        }
        public function  getproductbyId($id)
        {
            $query ="SELECT * FROM tbl_product WHERE productId='$id'";
            $result=$this->db->select($query);
            return $result;
        }
        public function  update_product($data,$files, $id)
        {
      
            $productName=mysqli_real_escape_string($this->db->link, $data['productName']);
            $category=mysqli_real_escape_string($this->db->link, $data['category']);
            $brand=mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc=mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price=mysqli_real_escape_string($this->db->link, $data['price']);
            $type=mysqli_real_escape_string($this->db->link, $data['type']);
            $permited=array('jpg', 'jpeg', 'png', 'gif');   
            $file_name=$_FILES['image']['name'];
            $file_size=$_FILES['image']['size'];
            $file_temp=$_FILES['image']['tmp_name'];

            $div=explode('.', $file_name);
            $file_ext=strtolower(end($div));
            $unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image="uploads/".$unique_image;
            if($productName=="" || $category=="" || $brand==""||$product_desc==""||$price==""||$type==""){
                $alert = "<span class='error'>Fiels must be not empty</span>";
                return $alert;  
            }else{
                if(!empty($file_name)){
                    // neu nguoi dung chon anhr
                    if($file_size>2048000 ){
                     
                        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
                        return $alert;
                    }elseif(in_array($file_ext, $permited)=== false){
              
                        $alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        return $alert;  
                    }
                    $delname="SELECT image FROM tbl_product WHERE productId='$id'";
                    $delta=$this->db->select($delname);
                    
                    $string=""; 
                    while($rowData=$delta->fetch_assoc()){
                        $string .= $rowData['image'];
                    }
                    
                    $delLink="uploads/".$string;
                    unlink($delLink);
                    $query ="UPDATE tbl_product SET productName='$productName', catId='$category', brandId='$brand', product_desc='$product_desc', price='$price', type='$type', image='$unique_image' WHERE productId='$id'";
                    move_uploaded_file($file_temp, $uploaded_image);
                }else{
                    //  nguoi dung khong chon anh
                    $query ="UPDATE tbl_product SET productName='$productName', catId='$category', brandId='$brand', product_desc='$product_desc', price='$price', type='$type' WHERE productId='$id'";
                    
                }
                $result=$this->db->update($query);
            
                if($result){
                    $alert = "<span class='success'>Success</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Not Success</span>";                        
                    return $alert;
                }
            }  
        }
        public function  delete_product($id)
        {
            $query ="DELETE FROM tbl_product WHERE productId='$id'";
            $result=$this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Success</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Not Success</span>";
                return $alert;
            }
        }
        public function  getproduct_feathered()
        {
            $query ="SELECT * FROM tbl_product WHERE type=1 ORDER BY productId DESC LIMIT 4";
            $result=$this->db->select($query);
            return $result;
        }  
        public function  getproduct_new()
        {
            $query ="SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 2 ";
            $result=$this->db->select($query);
            return $result;
        }  
        public function  get_details($id)
        {
            $query ="SELECT  tbl_product .*, tbl_category.*, tbl_brand.*FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId=tbl_category.catId 
            INNER JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandId WHERE tbl_product.productId='$id' ";
            $result=$this->db->select($query);
            return $result;
        }  
        public  function getproductbycat($id){
            $query="SELECT * FROM tbl_category, tbl_product WHERE tbl_categiry.catId='$id' AND tbl_product.catId='$id' ORDER BY ASC LIMIT 1";
            $result=$this->db->select($query);
            return $result;
        }
        public function insert_Compare($productid, $customer_id){
            $productid=mysqli_real_escape_string($this->db->link, $productid);
            $customer_id=mysqli_real_escape_string($this->db->link, $customer_id);
            
            $query_compare="SELECT *FROM tbl_compare WHERE productId='$productid' AND customer_id='$customer_id'";
            $check_cart =  $this->db->select($query_compare); 
            if($check_cart){
                $msg="Compare Added";
                return $msg;
            }
            else{
                $query="SELECT * FROM tbl_product WHERE productId='$productid' ";
                $result=$this->db->select($query)->fetch_assoc();
                $productName=$result['productName'];
                $price=$result['price'];
                $image=$result['image'];
                $query_insert="INSERT INTO tbl_compare(customer_id, productName, productId, price, image) VALUES('$customer_id', '$productName', '$productid', '$price','$image')";
                $result_insert=$this->db->insert($query_insert);
                if($result_insert){
                    $alert = "<span class='success'>Success</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Not Success</span>";
                    return $alert;
                }
            }
        }
        public function get_compare($customer_id){
            $query="SELECT * FROM tbl_compare WHERE customer_id='$customer_id' ORDER BY id ASC";
            $result_query=$this->db->select($query);
            return $result_query;
        }
        public function insert_Wishlist($productid, $customer_id){
            $productid=mysqli_real_escape_string($this->db->link, $productid);
            $customer_id=mysqli_real_escape_string($this->db->link, $customer_id);
            
            $query_compare="SELECT *FROM tbl_wishlist WHERE productId='$productid' AND customer_id='$customer_id'";
            $check_cart =  $this->db->select($query_compare); 
            if($check_cart){
                $msg="Wishlist Added";
                return $msg;
            }
            else{
                $query="SELECT * FROM tbl_product WHERE productId='$productid' ";
                $result=$this->db->select($query)->fetch_assoc();
                $productName=$result['productName'];
                $price=$result['price'];
                $image=$result['image'];
                $query_insert="INSERT INTO tbl_wishlist(customer_id, productName, productId, price, image) VALUES('$customer_id', '$productName', '$productid', '$price','$image')";
                $result_insert=$this->db->insert($query_insert);
                if($result_insert){
                    $alert = "<span class='success'>Success</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Not Success</span>";
                    return $alert;
                }
            }
        }
        public function insert_slider($data, $files){
            $sliderName=mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $type=mysqli_real_escape_string($this->db->link, $data['type']);
          
            $permited=array('jpg', 'jpeg', 'png', 'gif');   
            $file_name=$_FILES['image']['name'];
            $file_size=$_FILES['image']['size'];
            $file_temp=$_FILES['image']['tmp_name'];

            $div=explode('.', $file_name);
            $file_ext=strtolower(end($div));
            $unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image="uploads/".$unique_image;
            if($sliderName=="" || $type==""){
                $alert = "<span class='error'>Fiels must be not empty</span>";
                return $alert;
            }
            else{
                if(!empty($file_name)){
                    // neu nguoi dung chon anhr
                    if($file_size>2048000 ){
                    
                        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
                        return $alert;
                    }elseif(in_array($file_ext, $permited)=== false){
            
                        $alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        return $alert;  
                    }
                    
                    $query="INSERT INTO tbl_slider(sliderName, image, type) VALUES('$sliderName', '$unique_image', '$type')";
                    move_uploaded_file($file_temp, $uploaded_image);
                    $result=$this->db->insert($query);
                    
                    if($result){
                        $alert = "<span class='success'>Success</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'>Not Success</span>";                        
                        return $alert;
                    }
                }
                
            }     
        }
        public function get_slider_active(){
            $query="SELECT * FROM tbl_slider WHERE type='1'";
            $result=$this->db->select($query);
            return $result;
        }
        public function get_slider(){
            $query="SELECT * FROM tbl_slider";
            $result=$this->db->select($query);
            return $result;
        }
        public function update_type_slider($id, $type){
            $type=mysqli_real_escape_string($this->db->link, $type);
            $query="UPDATE tbl_slider SET type='$type' WHERE sliderId='$id'";
            $result=$this->db->update($query);
            return $result;
        }
        public function del_slider($id){
            $delname="SELECT image FROM tbl_slider WHERE sliderId='$id'";
            $delta=$this->db->select($delname);
                    
            $string=""; 
            while($rowData=$delta->fetch_assoc()){
                $string .= $rowData['image'];
            }
                    
            $delLink="uploads/".$string;
            unlink($delLink);// xoa anh trong file upload khi xoa slider

            $query="DELETE FROM tbl_slider WHERE sliderId='$id'";
            $result=$this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Success</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Not Success</span>";                        
                return $alert;
            }
        }
        public function search_product($tukhoa){
            $tukhoa=$this->fm->validation($tukhoa);
            $query_cat="SELECT catId FROM tbl_category WHERE catName LIKE '%$tukhoa%'";         
            $result_cat=$this->db->select($query_cat);
            
            if($result_cat){
                $result_search_cat=$result_cat->fetch_assoc();
                $catId=$result_search_cat['catId'];
                $query="SELECT * FROM tbl_product WHERE (productName LIKE'%$tukhoa%' OR catId='$catId')";
            }else{
                $query="SELECT * FROM tbl_product WHERE (productName LIKE'%$tukhoa%')";
            }
            $result=$this->db->select($query);
            return $result;
        }
    }
    
?>