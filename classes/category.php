<?php
    $filepath=realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
    class category
    {   
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function  insert_category($catName)
        {
            $catName=$this->fm->validation($catName);
            $catName=mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            }
            else{
                $query ="INSERT INTO tbl_category(catName) values('$catName')";
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
        public function  show_category()
        {
            $query ="SELECT * FROM tbl_category ORDER BY catId ASC";
            $result=$this->db->select($query);
            return $result;
        }
        public function  getcatbyId($id)
        {
            $query ="SELECT * FROM tbl_category WHERE catId='$id' ORDER BY catId ASC";
            $result=$this->db->select($query);
            return $result;
        }
        public function  update_category($catName, $id)
        {
            $catName=$this->fm->validation($catName);
            $catName=mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            }
            else{
                $query ="UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
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
        public function  delete_category($id)
        {
            $query ="DELETE FROM tbl_category WHERE catId='$id'";
            $result=$this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Success</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Not Success</span>";
                return $alert;
            }
        }
        public  function getproductbycat($id){
            $query="SELECT * FROM tbl_category, tbl_product WHERE tbl_category.catId='$id' AND tbl_product.catId='$id' ";
            $result=$this->db->select($query);
            return $result;
        }
        public  function getnamecat($id){
            $query="SELECT * FROM tbl_category WHERE tbl_category.catId='$id' ";
            $result=$this->db->select($query);
            return $result;
        }
        
    }
    
?>