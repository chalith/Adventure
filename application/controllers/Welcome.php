<?php
class Welcome extends CI_Controller {
        public function __construct() {
            parent::__construct();
            //$this->load->model('login_model');
            $this->load->model('shopmodel');
            $this->load->model('login_model');
            $this->load->model('frontpage_model');
            $this->load->model('follow_model');
            
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
            $data['activities']=$this->frontpage_model->getActivities();
            $data['providers']=$this->frontpage_model->getProviders();
            $data['advertisements']=$this->frontpage_model->getAdvertisements();
            $this->load->view('home_view',$data);
        }
        
        public function getGeneralFeatures($param1){
            $this->load->model('generalFeaturesModel','',TRUE);
            $data['generalfeature']=$this->generalFeaturesModel->getGeneralFeatures($param1);
            $data['activities']=$this->frontpage_model->getActivities();
//            $data['shops'] = $this->generalFeaturesModel->generalFeaturesProvider($param1);
            $this->load->view('generalFeaturesView', $data);
            
        }
        
        public function getShopProfileView($id){
            $result = $this->shopmodel->get_Shop($id);
            $picture = $this->login_model->getPicture("provider",$id);
            $data['shopid']=$id;
            $data['shopemail']=$result->email;
            $data['name']=$result->shopName;
            $data['owner']=$result->ownerName;
            $data['address']=$result->address;
            $data['fax']=$result->fax;
            $data['about']=$result->about;
            $data['shoppicture']=$picture;
            $result = $this->shopmodel->get_Mobilenumbers($id);
            
            $data['mobilenumbers']=$result;
            
            $result = $this->shopmodel->get_Packages($id);
            
            $data['shoppackages']=$result;
            
            $this->load->view('shopprofile',$data);
        }
        
	public function getShopView($param1){
            /*$this->load->model('generalFeaturesModel','',TRUE);
            $data['generalfeature']=$this->generalFeaturesModel->getGeneralFeatures($param1);
            $data['activities']=$this->frontpage_model->getActivities();*/
            $data['id']=$param1;
            $this->load->view('shopView', $data);
            
        }
		
        public function registerCustomer(){
            
           
            $myname = $this->input->post('customerpass');
            $packet1 = array("name" => $myname);
            $this->load->model('register_model');
            $this->register_model->registerCustomer($packet1);
        }
		
		
}
?>