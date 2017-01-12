<?php

class Shop_model extends CI_Model{
        public function __construct() {
            parent::__construct();
            //$this->load->library('session');
        }
        
        public function specialOffers($data){
            $specialoff = array(
                "shopid" => $data["shopid"],
                "title" => $data["title"],
                "details" => $data["details"],
                "start" => $data["start"],
                "duration" => $data["duration"]
            );
            $this->db->insert('specialoffer', $specialoff);
            $alert['msg'] = "Special Offer Succesfully Published";
            return;
        }
        
}

?>

