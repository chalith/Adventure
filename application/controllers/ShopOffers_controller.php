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
            $start = $this->input->post("sodate");
            $duration = $this->input->post("soduration");
            
            
            $shopid = $_SESSION['id'];
            
            $data = array(
                "shopid" => $shopid,
                "title" => $title,
                "details" => $details,
                "start" => $start,
                "duration" => $duration
            );
            $this->load->model('shop_model');
            $alert = $this->shop_model->specialOffers($data);
            echo $alert;
            return;
                    
            
        }
}

?>