<?php
    $filepath=realpath(dirname(__FILE__));

    include ($filepath.'/../lib/session.php');
    session::checkLogin();
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');

?>
<?php
    class adminlogin  
    {   
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db=new Database();
            $this->fm=new Format();
        }
        public function  login_admin($adminUser, $adminPass)
        {
            $adminUser=$this->fm->validation($adminUser);
            $adminPass=$this->fm->validation($adminPass);
            $adminUser=mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass=mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass)){
                $alert="User and Password must be not empty";
                return $alert;
            }
            else{
                $query ="SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass' LIMIT 1";
                $result=$this->db->select($query);
                if($result == true){
                    $value=$result->fetch_assoc();
                    session::set('adminlogin', true);
                    session::set('adminId', $value['adminID']);
                    session::set('adminUser', $value['adminUser']);
                    session::set('adminName', $value['adminName']);
                    header('location: index.php');
                }else{
                    $alert="User and Password not match";
                    return $alert;
                }
            }
        }
    }
    
?>