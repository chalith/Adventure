<?php
    class CustomerModel extends CI_Model{
        public function __construct() {
            parent::__construct();
        }
        public function get_Customer($id){
            $where = "id='$id'";
            $this->db->where($where);
            $query=$this->db->get('customer');
            $result = $query->result();
            return $result[0];      
        }
        
    }
?>