<?php
class Welcome extends CI_Controller {
        public function __construct() {
            parent::__construct();
            //$this->load->model('Login_model');
            $this->load->model('ShopModel');
            $this->load->model('Login_model');
            $this->load->model('Frontpage_model');
            
            
        }
        
        public function index(){
            $this->home();
        }
        public function home(){
            $data['email']="";
                
            /*if(isset($_SESSION['email'])){
                $data['email']=$_SESSION['email'];
                $data['id']=$_SESSION['id'];
                $data['person']=$_SESSION['person'];
                $data['picture']=$this->login_model->getPicture($_SESSION['person'],$_SESSION['id']);
            }*/
            $data['alert']="";
            $data['activities']=$this->Frontpage_model->getActivities();
            $data['providers']=$this->Frontpage_model->getProviders();
            $data['advertisements']=$this->Frontpage_model->getAdvertisements();
            $this->load->view('home_view',$data);
        }
        
        public function getGeneralFeatures($param1){
            $this->load->model('GeneralFeaturesModel','',TRUE);
            $data['generalfeature']=$this->GeneralFeaturesModel->getGeneralFeatures($param1);
            $data['activities']=$this->Frontpage_model->getActivities();
//            $data['shops'] = $this->GeneralFeaturesModel->generalFeaturesProvider($param1);
            $this->load->view('generalFeaturesView', $data);
            
        }
        
        public function getShopProfileView(){
            if(!isset($_SESSION['email'])){
               $this->home();
            }
            $email = $_SESSION['email'];
            $id = $_SESSION['id'];
            $person = $_SESSION['person'];
            $result = $this->ShopModel->get_Shop($id);
            $picture = $this->Login_model->getPicture("provider",$id);
            
            $data['email']=$result->email;
            $data['name']=$result->shopName;
            $data['owner']=$result->ownerName;
            $data['address']=$result->address;
            $data['fax']=$result->fax;
            $data['about']=$result->about;
            $data['picture']=$picture;
            
            $result = $this->Sh0opModel->get_Mobilenumbers($id);
            
            $data['mobilenumbers']=$result;
            
            $result = $this->ShopModel->get_Packages($id);
            
            $data['packages']=$result;
            
            $this->load->view('shopprofile',$data);
        }
        
	public function getShopView($param1){
            /*$this->load->model('GeneralFeaturesModel','',TRUE);
            $data['generalfeature']=$this->GeneralFeaturesModel->getGeneralFeatures($param1);
            $data['activities']=$this->Frontpage_model->getActivities();*/
            $data['id']=$param1;
            $this->load->view('shopView', $data);
            
        }
		
        public function registerCustomer(){
            
           
            $myname = $this->input->post('customerpass');
            $packet1 = array("name" => $myname);
            $this->load->model('Register_model');
            $this->Register_model->registerCustomer($packet1);
        }
		
		
}
?>