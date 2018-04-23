<?php
    class Login_controller extends CI_Controller{
        public function __construct() {
            parent::__construct();
            //$this->load->library('session');
            $this->load->model('Login_model');
            $this->load->model('Validate');
            $this->load->model('Encryptor');
        }
        public function index(){
            $this->load->view('home_view');
        }
        public function log_in(){
            $email = $this->db->escape_str($this->Validate->get_input($this->input->post('email')));
            $password = $this->Encryptor->encryptPwrd($this->Validate->get_input($this->input->post('password')));
            $pwrd = $this->Login_model->getPassword($email);
            
                
            if($pwrd!=NULL){
                $person = $this->Login_model->getPerson($email);
                $id = $this->Login_model->getID($person,$email);
                if($password==$pwrd){
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['person'] = $person;
                    $_SESSION['picture']=$this->Login_model->getPicture($_SESSION['person'],$_SESSION['id']);
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
            return $this->Login_model->getPicture($id);
        }
    }
    
?>
