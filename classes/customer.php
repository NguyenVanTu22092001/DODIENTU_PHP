<?php
    $filepath=realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
    class customer
    {   
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function insert_customers($data){
            $name=mysqli_real_escape_string($this->db->link, $data['name']);
            $address=mysqli_real_escape_string($this->db->link, $data['address']);
            $city=mysqli_real_escape_string($this->db->link, $data['city']);
            $country=mysqli_real_escape_string($this->db->link, $data['country']);
            $zipcode=mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $phone=mysqli_real_escape_string($this->db->link, $data['phone']);
            $email=mysqli_real_escape_string($this->db->link, $data['email']);
            $password=mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($name==""|| $address==""||$city==""||$country==""||$zipcode==""||$phone==""||$email==""){
                $alert="<span>Fiels must be not empty</span>";
            }else{
                $check_email="SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
                $result_check=$this->db->select($check_email);
                if($result_check){
                    $alert="<span>Email already existed </span>";
                    return $alert;
                }else{
                    $query ="INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) values('$name', '$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";
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
        public function login_customers($data){
            $email=mysqli_real_escape_string($this->db->link, $data['email']);
            $password=mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($email==''|| $password==''){
                $alert="<span>Email and Password must be not empty</span>";
                return $alert;
            }else{
                $check_email="SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
                $result_check=$this->db->select($check_email);
                if($result_check){
                    $result= $result_check->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_id', $result['id']);
                    Session::set('customer_name', $result['name']);
                    header('location: index.php');
                }else{
                    $alert = "<span class='error'>Email and Password doesn't match</span>";
                    return $alert;
                }
            }
        }
        public function show_customers($id){
            $query="SELECT * FROM tbl_customer WHERE id='$id'";
            $result=$this->db->select($query);
            return $result;
        }
        public function update_Customers($data, $id){
            $name=mysqli_real_escape_string($this->db->link, $data['name']);
            $address=mysqli_real_escape_string($this->db->link, $data['address']);
            $city=mysqli_real_escape_string($this->db->link, $data['city']);
            $country=mysqli_real_escape_string($this->db->link, $data['country']);
            $zipcode=mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $phone=mysqli_real_escape_string($this->db->link, $data['phone']);
         
            if($name==""|| $address==""||$city==""||$country==""||$zipcode==""||$phone==""){
                $alert="<span>Fiels must be not empty</span>";
                return $alert;
            }else{
                $query ="UPDATE tbl_customer SET name='$name', address='$address', city='$city', country='$country', zipcode='$zipcode', phone='$phone'   WHERE id='$id'";

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
        public function insert_comment($id){
            $id=mysqli_real_escape_string($this->db->link, $id);
            $commentName=$_POST['commentName'];
            $detail=$_POST['detail'];
            if($commentName==""||$detail==""){
                $alert="<span>Fiels must be not empty</span>";
                return $alert;
            }else{
                $query ="INSERT INTO tbl_comment(commentName, detail, productId) VALUES('$commentName','$detail', '$id')";
                $result=$this->db->insert($query); 
                if($result){
                    $alert = "<span class='success'>Thanks for the comment</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Not Success</span>";
                    return $alert;
                }
            }
        }
    }
    
?>