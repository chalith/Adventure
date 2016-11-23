<?php
class Welcome extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model('login_model');
            
            $this->load->model('frontpage_model');
            
        }
        
        public function index(){
            $this->home();
        }
        public function home(){
            $data['email']="";
            session_start();    
                
            if(isset($_SESSION['email'])){
                $data['email']=$_SESSION['email'];
                $data['id']=$_SESSION['id'];
                $data['person']=$_SESSION['person'];
                $data['picture']=$this->login_model->getPicture($_SESSION['person'],$_SESSION['id']);
            }
            $data['alert']="";
            $data['activities']=$this->frontpage_model->getActivities();
            $data['providers']=$this->frontpage_model->getProviders();
            $data['advertisements']=$this->frontpage_model->getAdvertisements();
            $this->load->view('home_view',$data);
        }
}
?>