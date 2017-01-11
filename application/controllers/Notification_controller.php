<?php
    class Notification_controller extends CI_Controller{
        function __construct() {
            parent::__construct();
            $this->load->model('notification_model');
        }
        public function get_NotificationCount() {
            session_start();
            $id = $_SESSION['id'];
            $reservation = $this->notification_model->get_ReviewedReservationCount($id);
            echo json_encode(array('count'=>$reservation));
        }
        public function get_Notifications(){
            session_start();
            $id = $_SESSION['id'];
            $result = $this->notification_model->get_ReviewedReservations($id);
            $data=array();
            foreach ($result as $obj){
                $id=$obj->reservationID;
                $package=$this->notification_model->get_ReservedPackege($id);
                $shop=$this->notification_model->get_ShopName($package->shopID);
                array_push($data, array('id'=>$id,'package'=>$package->packageName,'shopName'=>$shop->shopName));
            
            }
            echo json_encode($data);
        }
        public function set_Viewed($reservationID) {
            $time=  date("Y-m-d h:i:sa");
            $view=array('reservationID'=>$reservationID,'viewedTime'=>$time);
            $this->notification_model->set_Viewed($view);
        }
    }
?>