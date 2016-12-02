<?php
    class Login_model extends CI_Model{
        public function __construct() {
            parent::__construct();
        }
        public function getID($email){
            $query = $this->db->query("SELECT id FROM provider WHERE email = '".$email."'");
            if($query->num_rows()>0){
                $obj = $query->result();
                return $obj[0]->id;
            }
            else{
                return NULL;
            }
        }
        public function getPassword($email){
            $query = $this->db->query("SELECT password FROM user WHERE email = '".$email."'");
            if($query->num_rows()>0){
                $obj = $query->result();
                return $obj[0]->password;
            }
            else{
                return NULL;
            }
        }
        public function getPicture($table,$id){
            $query = $this->db->query("SELECT picture FROM $table WHERE id = '".$id."'");
            if($query->num_rows()>0){
                $obj = $query->result();
                return $obj[0]->picture;
            }
            else{
                return NULL;
            }
        }
        public function getPerson($email){
            $query = $this->db->query("SELECT userType FROM user WHERE email = '".$email."'");
            if($query->num_rows()>0){
                $obj = $query->result();
                return $obj[0]->userType;
            }
            else{
                return NULL;
            }
            //return "provider";
        }
    }
?>
