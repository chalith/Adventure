<?php

class GeneralFeaturesModel extends CI_Model{
    
    public function getGeneralFeatures($param1){
       $query = $this->db->get_where('generalfeatures',array('activityID'=>$param1),1);
       return $query->result();
        
			
    }
//    
//    public function generalFeaturesProvider($param1){
//        
//        $shops = array(array('name'=>'KelaniRiver', 'price'=>'1200.00'), array("name"=>"Adventurer","price"=>"1000.00"));
//        return $shops;
//    }
}
