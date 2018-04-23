<?php

class ShopOffers_model extends CI_Model{
        public function __construct() {
            parent::__construct();
            //$this->load->library('session');
        }
        
        public function specialOffers($data){
            $specialoff = array(
                "shopid" => $data["shopid"],
                "title" => $data["title"],
                "details" => $data["details"]
                
//                "start" => $data["start"],
//                "duration" => $data["duration"]
            );
            $this->db->insert('specialoffer', $specialoff);
            $alert['msg'] = "Special Offer Succesfully Published";
            return $alert;
        }
        
        public function getFollowers($senderid){
            $query = $this->db->get_where('following', array("shopID"=>$senderid));
            
            $result = $query->result();
            return $result;
            
        }
        
        public function notifyFollowersModel($data){
            
            $this->db->insert('notifications', $data);
            
//            $alerts['msg2'] = "Notified Followers";
            
            return;
        }
}

?>

