<?php
    class Login_controller extends CI_Controller{
        public function __construct() {
            parent::__construct();
            //$this->load->library('session');
            $this->load->model('login_model');
            $this->load->model('validate');
            $this->load->model('encryptor');
        }
        public function index(){
            $this->load->view('home_view');
        }
        public function log_in(){
            $email = $this->db->escape_str($this->validate->get_input($this->input->post('email')));
            $password = $this->encryptor->encryptPwrd($this->validate->get_input($this->input->post('password')));
            $pwrd = $this->login_model->getPassword($email);
            
                
            if($pwrd!=NULL){
                $person = $this->login_model->getPerson($email);
                $id = $this->login_model->getID($person,$email);
                if($password==$pwrd){
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['person'] = $person;
                    $_SESSION['picture']=$this->login_model->getPicture($_SESSION['person'],$_SESSION['id']);
                    echo json_encode(array('alert'=>"true"));
                    return;
                    
                    //$data["alert"]="<script>alert(\"logged\");</script>";
                }else{
                    echo json_encode(array('alert'=>"Password is incorrect"));
                    return;
                    //$data["alert"]="<script>alert(\"Password is incorrect\");</script>";
                }
            }else{
                echo json_encode(array('alert'=>"$email is not registered in the system"));
                return;
                //$data["alert"]="<script>alert(\"$email is not registered in the system\");</script>";
            }
            //$this->load->view('home_view',$data);
        }
        public function log_out(){
            session_start();
            session_destroy();
        }
        public function loadPicture($id){
            return $this->login_model->getPicture($id);
        }
    }
    
?>
