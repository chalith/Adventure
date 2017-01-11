<?php
    class Frontpage_model extends CI_Model{
        public function __construct() {
            parent::__construct();
        }
        public function getActivities(){
            $query = $this->db->query("SELECT * FROM generalfeatures");
            if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return NULL;
            }
        }
        public function getProviders(){
            $query = $this->db->query("SELECT * FROM provider");
            if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return NULL;
            }
        }
        public function getAdvertisements(){
            $query = $this->db->query("SELECT * FROM advertisement");
            //$add["shopname"] = "";
            //$add["shoppic"] = "";
            if($query->num_rows()>0){
                foreach ($query->result() as $object){
                    $query2 = $this->db->query("SELECT shopName,picture FROM provider WHERE id = '".$object->shopID."'");
                    foreach ($query2->result() as $object2){
                        if($query2->num_rows()>0){
                            $add["shopname"] = $object2->shopName;
                            $add["shoppic"] = $object2->picture;
                        }
                    }
                    $add["title"] = $object->title;
                    $add["description"] = $object->description;
                    $res[$add["shopname"].$add["title"]] = $add;
                }
                return $res;
            }
            else{
                return NULL;
            }
        }
    }
?>
