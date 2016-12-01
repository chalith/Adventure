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
//            $data['activities']=$this->frontpage_model->getActivities();
            $data['providers']=$this->frontpage_model->getProviders();
            $data['advertisements']=$this->frontpage_model->getAdvertisements();
            $this->load->view('home_view',$data);
        }
        
        public function getGeneralFeatures($param1){
            if ($param1 == 'WT')
                $param1 = "Waterfall Trekking";
            elseif ($param1 == 'Cycle')
                $param1 = "Cycling Trips";
            elseif ($param1 == 'Jump')
                $param1 = "Confidence Jumps in natural stream slides"; 
                $this->load->model('generalFeaturesModel','',TRUE);
                $data['generalfeature']=$this->generalFeaturesModel->getGeneralFeatures($param1);
                $this->load->view('generalFeaturesView', $data);
            
        }
        
        public function registerCustomer(){
            
           
            $myname = $this->input->post('customerpass');;
            $packet1 = array("name" => $myname);
            $this->load->model('register_model');
            $this->register_model->registerCustomer($packet1);
        }
}
?>