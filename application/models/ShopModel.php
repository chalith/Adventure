<?php
    class ShopModel extends CI_Model{
        public function __construct() {
            parent::__construct();
            session_start();
        }
        public function get_Shop($id){
            $where = "id='$id'";
            $this->db->where($where);
            $query=$this->db->get('provider');
            $result = $query->result();
            return $result[0];       
        }
        public function get_Mobilenumbers($id){
            $where = "shopID='$id'";
            $this->db->where($where);
            $query=$this->db->get('shopmobilenumber');
            $result = $query->result();
            return $result;
        }
        public function get_Packages($id){
            $sql = "SELECT pkg.packageName AS packageName, pkg.about AS about, pkg.durationDays AS durationDays, pkg.durationHours AS durationHours, pkg.meals AS meals, pkg.price AS price, pkg.picture AS picture FROM package pkg INNER JOIN provider ON provider.id = pkg.shopID WHERE provider.id = '$id'";
            $query=$this->db->query($sql);
            $result = $query->result();
            if(count($result)>0){
                return $result;
            }
            else{
                return NULL;
            }
        }
        
    }
?>