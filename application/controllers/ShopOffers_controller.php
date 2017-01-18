<?php

class ShopOffers_controller extends CI_Controller{
        public function __construct() {
            parent::__construct();
            session_start();
            //$this->load->library('session');
//            $this->load->model('validate');
//            $this->load->model('encryptor');
            
        }
        
        public function insertSpecialOffers(){
            $shopid=$title = $details = $start = $duration = "";
            $title = $this->input->post("sotitle");
            $details = $this->input->post("sodetails");
//            $start = $this->input->post("sodate");
//            $duration = $this->input->post("soduration");
//            
            
            $shopid = $_SESSION['id'];
            $dt = date("Y-m-d h:i:sa");
            $data = array( 
                "shopid" => $shopid,
                "title" => $title,
                "details" => $details
                
//                "start" => $start,
//                "duration" => $duration
            );
            $this->load->model('shopoffers_model');
            $alert = $this->shopoffers_model->specialOffers($data);
            $results = $this->shopoffers_model->getFollowers($shopid);
            $alert2 = $this->notifyFollowers($results);
            echo $alert;
            echo $alert2;
            return;
                    
            
        }
        
        public function notifyFollowers($results){
            
               
            
            
            foreach ($results as $result){
                     
                $senderID = $result->shopID;
                $content = "Check out the special offer recently posted by us";
                $time=  date("Y-m-d h:i:sa");
                $receiverID = $result->customerID;
                
                
                $data = array(
                    "senderID" => $senderID,
                    "receiverID" => $receiverID,
                    "notification" => $content,
                    "sendTime" => $time
                );
                
                $this->load->model('shopoffers_model');
                $this->shopoffers_model->notifyFollowersModel($data);
               
            }
            $alert2 = "Notified all followers";
            return $alert2;
        }
        
       
}

?>