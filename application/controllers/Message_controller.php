<?php
    class Message_controller extends CI_Controller{
        function __construct() {
            parent::__construct();
            $this->load->model('Message_model');
        }
        public function send_Message() {
            session_start();
            $id = $_SESSION['id'];
            $targetID=$message=$time="";
            $targetID = $this->input->post('targetid');
            $message = $this->input->post('message');
            $time=  date("Y-m-d h:i:sa");
            $data = array(
                "senderID"=>$id,
                "receiverID"=>$targetID,
                "message"=>$message,
                "sendTime"=>$time
            );
            $msg = $this->Message_model->send_Message($data);
            echo json_encode(array("alert"=>$msg));
        }
        public function get_Messages($senderID) {
            session_start();
            $id = $_SESSION['id'];
            $results = $this->Message_model->get_Messages($senderID,$id);
            $msg = array();
            foreach ($results as $obj){
                $cur = NULL;
                if($obj->senderID==$id){
                    $name = $this->Message_model->get_Name($obj->receiverID);
                    $cur=array('type'=>"sent",'id'=>$obj->receiverID,'name'=>$name['name'],'picture'=>$name['picture'],'message'=>$obj->message,'time'=>$obj->sendTime);
                }
                else if($obj->receiverID==$id){
                    $name = $this->Message_model->get_Name($obj->senderID); 
                    $cur=array('type'=>"received",'id'=>$obj->senderID,'name'=>$name['name'],'picture'=>$name['picture'],'message'=>$obj->message,'time'=>$obj->sendTime);
                }
                array_push($msg, $cur);
            }
            $time=  date("Y-m-d h:i:sa");
            $data=array('senderID'=>$senderID,'receiverID'=>$id,'receiveTime'=>$time);
            $this->Message_model->set_Read($data);
            echo json_encode($msg);
        }
        public function get_Senders() {
            session_start();
            $id = $_SESSION['id'];
            $results = $this->Message_model->get_Senders($id);
            $set = array();
            $added = array();
            foreach ($results as $obj){
                $cur = NULL;
                if($obj->senderID==$id){
                    $name = $this->Message_model->get_Name($obj->receiverID);
                    $cur=array('id'=>$obj->receiverID,'name'=>$name['name'],'picture'=>$name['picture'],'lastmessage'=>$obj->message,'time'=>$obj->sendTime);
                }
                else if($obj->receiverID==$id){
                    $name = $this->Message_model->get_Name($obj->senderID); 
                    $cur=array('id'=>$obj->senderID,'name'=>$name['name'],'picture'=>$name['picture'],'lastmessage'=>$obj->message,'time'=>$obj->sendTime);
                }
                if(!in_array($cur['id'], $added)){
                    array_push($added, $cur['id']);
                    array_push($set, $cur);
                }
            }
            echo json_encode($set);
        }
        public function get_ReceivedMsgCount($senderID=""){
            session_start();
            $id = $_SESSION['id'];
            $results = $this->Message_model->get_ReceivedMsgCount($senderID,$id);
            echo json_encode(array("count"=>$results));
        }
    }
?>