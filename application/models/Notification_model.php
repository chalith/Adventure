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
        
        public function get_ReservationCount($id){
            $sql = "SELECT COUNT(res.reservationID) AS count FROM reservation res INNER JOIN reservedpackage INNER JOIN package pkg INNER JOIN provider WHERE reservedpackage.packageID=pkg.packageID and res.reservationID = reservedpackage.reservationID AND provider.id = '$id' AND res.acceptedDate IS NULL AND res.viewedTime IS NULL;";
            $query=$this->db->query($sql);
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
            $this->db->order_by("acceptedDate", "DESC"); 
            $query=$this->db->get('reservation');
            $result=$query->result();
            return $result;
        }
        
        public function get_Reservations($id){
            $sql = "SELECT res.reservationID AS reservationID,res.totalPrice AS totalPrice,res.reserveDate AS reserveDate,res.customerID AS customerID,pkg.packageName AS packageName,pkg.shopID AS shopID FROM reservation res INNER JOIN reservedpackage INNER JOIN package pkg INNER JOIN provider WHERE reservedpackage.packageID=pkg.packageID and res.reservationID = reservedpackage.reservationID AND provider.id = '$id' AND res.acceptedDate IS NULL AND res.viewedTime IS NULL ORDER BY res.reserveDate DESC;";
            $query=$this->db->query($sql);
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
            $this->db->order_by("sendTime", "dsc"); 
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
        public function get_Customer($id){
            $where = "id='$id'";
            $this->db->where($where);
            $query=$this->db->get('customer');
            $result = $query->result();
            return $result[0];       
        }
        public function set_Viewed($data) {
            $where = "reservationID='$data[id]' AND acceptedDate IS NOT NULL AND viewedTime IS NULL";
            $this->db->where($where);
            $this->db->update('reservation', array('viewedTime'=>$data['viewedTime']));
        }
        public function delete_Notify($data) {
            $where = "id='$data[id]'";
            $this->db->where($where);
            $this->db->delete('notifications');
        }
        public function delete_Reservation($data) {
            $where = "reservationID='$data[id]'";
            $this->db->where($where);
            $this->db->delete('reservation');
            $where = "reservationID='$data[id]'";
            $this->db->where($where);
            $this->db->delete('reservedpackage');
        }
        public function set_Accepted($data) {
            $where = "reservationID='$data[id]' AND acceptedDate IS NULL";
            $this->db->where($where);
            $this->db->update('reservation', array('acceptedDate'=>$data['acceptedDate']));
        }
         public function set_FollowViewed($data) {
            $where = "id='$data[id]'";
            $this->db->where($where);
            $this->db->update('notifications', array('viewedTime'=>$data['viewedTime']));
        }
    }
?>