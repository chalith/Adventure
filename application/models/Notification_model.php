<?php
    class Notification_model extends CI_Model{
        function __construct() {
            parent::__construct();
        }
        public function get_ReviewedReservationCount($id){
            $this->db->select(array('COUNT(reservationID) AS count'));
            $where = "customerID='$id' AND acceptedDate IS NOT NULL AND viewedTime IS NULL";
            $this->db->where($where);
            $query=$this->db->get('reservation');
            $result=$query->result();
            return $result[0]->count;
        }
        
         public function get_SONotificationCount($id){
            $this->db->select(array('COUNT(receiverID) AS count'));
            $where = "receiverID='$id' AND viewedTime IS NULL";
            $this->db->where($where);
            $query=$this->db->get('notifications');
            $result=$query->result();
            return $result[0]->count;
        }
        
        public function get_ReviewedReservations($id){
            $where = "customerID='$id' AND acceptedDate IS NOT NULL AND viewedTime IS NULL";
            $this->db->where($where);
            $this->db->order_by("acceptedDate", "asc"); 
            $query=$this->db->get('reservation');
            $result=$query->result();
            return $result;
        }
        public function get_ReservedPackege($reservationID) {
            $where = "reservationID='$reservationID'";
            $this->db->where($where);
            $query=$this->db->get('reservedpackage');
            $result=$query->result();
            $pid=$result[0]->packageID;
            
            $where = "packageID='$pid'";
            $this->db->where($where);
            $query=$this->db->get('package');
            $result = $query->result();
            return $result[0];
        }
        
        public function get_FollowNotifications($receiverID){
            $where = "receiverID='$receiverID' AND viewedTime IS NULL";
            $this->db->where($where);
            $query = $this->db->get('notifications');

            $result = $query->result_array();
            return $result;
        }
        public function get_ShopName($id){
            $where = "id='$id'";
            $this->db->where($where);
            $query=$this->db->get('provider');
            $result = $query->result();
            return $result[0];       
        }
        public function set_Viewed($data) {
            $where = "reservationID='$data[reservationID]' AND viewedTime IS NULL";
            $this->db->where($where);
            $this->db->update('reservation', array('viewedTime'=>$data['viewedTime']));
        }
         public function set_FollowViewed($data) {
            $where = "receiverID='$data[receiverID]' AND viewedTime IS NULL";
            $this->db->where($where);
            $this->db->update('notifications', array('viewedTime'=>$data['viewedTime']));
        }
    }
?>