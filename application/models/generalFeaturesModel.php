<?php

class GeneralFeaturesModel extends CI_Model{
    
    public function getGeneralFeatures($param1){
       $query = $this->db->get_where('generalfeatures',array('name'=>$param1),1);
       return $query->result();
        
			
    }
}
