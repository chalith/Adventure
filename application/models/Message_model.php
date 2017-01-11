<?php
    class Message_model extends CI_Model{
        function __construct() {
            parent::__construct();
        }
        public function get_Messages($senderID,$recieverID) {
            $where = "senderID='$senderID' AND receiverID='$recieverID' OR senderID='$recieverID' AND receiverID='$senderID'";
            $this->db->where($where);
            $this->db->order_by("sendTime", "asc"); 
            $query=$this->db->get('messages');
            return $query->result();
        }
        public function get_Senders($id) {
            $where = "senderID='$id' OR receiverID='$id'";
            $this->db->where($where);
            $this->db->order_by("sendTime", "desc");
            $query=$this->db->get('messages');
            return $query->result();
        }
        public function get_Name($id){
            if(substr($id, 0,  strlen("shop"))=="shop"){
                $this->db->where('id',$id);
                $query=$this->db->get('provider');
                $result=$query->result();
                return array('name'=>$result[0]->shopName,'picture'=>$result[0]->picture);
            }
            else if(substr($id, 0,  strlen("customer"))=="customer"){
                $this->db->where('id',$id);
                $query=$this->db->get('customer');
                $result=$query->result();
                return array('name'=>$result[0]->name,'picture'=>$result[0]->picture);
            }
        }
        public function send_Message($data){
            $this->db->insert('messages',$data);
            return "done";
        }
        public function get_ReceivedMsgCount($senderID,$id) {
            $this->db->select(array('COUNT(message) AS count'));
            if($senderID==""){
                $where = "receiverID='$id' AND receiveTime IS NULL";
                $this->db->where($where);
            }
            else{
                $where = "receiverID='$id' AND senderID='$senderID' AND receiveTime IS NULL";
                $this->db->where($where);
            }
            $query=$this->db->get('messages');
            $result=$query->result();
            return $result[0]->count;
        }
        public function set_Read($data) {
            $where = "receiverID='$data[receiverID]' AND senderID='$data[senderID]'AND receiveTime IS NULL";
            $this->db->where($where);$this->db->update('messages', array('receiveTime'=>$data['receiveTime']));
        }
    }
?>