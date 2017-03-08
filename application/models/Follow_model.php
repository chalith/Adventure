<?php
    class Follow_model extends CI_Model{
        public function __construct() {
            parent::__construct();
        }
        public function follow($followingid,$followerid){
            return (bool)$this->db->insert('following',array("shopID"=>$followingid,"customerID"=>$followerid));
        }
        public function unfollow($followingid,$followerid){
            $this->db->where(array('shopID'=>$followingid,'customerID'=>$followerid));
            return (bool)$this->db->delete('following');
        }
        public function isfollow($followingid,$followerid){
            $this->db->where(array('shopID'=>$followingid,'customerID'=>$followerid));
            $query=$this->db->get('following');
            $result=$query->result();
            if(count($result)>0){
                return true;
            }else{
                return false;
            }
        }
    }
?>