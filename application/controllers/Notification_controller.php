<?php

class Notification_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Notification_model');
    }

    public function get_NotificationCount() {
        session_start();
        $id = $_SESSION['id'];
        
        $reservation = $this->Notification_model->get_ReviewedReservationCount($id);
        
        $toreviewreservation = $this->Notification_model->get_ReservationCount($id);
//      
//            echo json_encode(array('count'=>$reservation));


        $socount = $this->Notification_model->get_SONotificationCount($id);
        
        

        $total = $reservation + $socount + $toreviewreservation;
        echo json_encode(array('count' => $total));
    }

    public function get_Notifications() {
        session_start();
        $id = $_SESSION['id'];

//            trial
        $data = array();
            
        $person = $_SESSION['person'];
        
        if($person == "customer"){

            $result = $this->Notification_model->get_ReviewedReservations($id);
            $data = array();
            foreach ($result as $obj) {
                $rid = $obj->reservationID;
                $package = $this->Notification_model->get_ReservedPackege($rid);
                $shop = $this->Notification_model->get_ShopName($package->shopID);
                $packageName = $package->packageName;
                $shopName = $shop->shopName;
                $notification = "The $packageName package you have booked from $shopName is reviewed and ready for you";
                $type = "ReviewedReservation";
                array_push($data, array('id' => $rid, 'type' => $type, 'name' => $shop->shopName, 'notification' => $notification));
            }
    //            echo json_encode(array('pro' => $data, 'status' => 0));
    //            

            $result2 = $this->Notification_model->get_FollowNotifications($id);

            foreach ($result2 as $obj){
                $senderID = $notification = $sendTime = $shop = $id ="";
                $senderID = $obj['senderID'];
                $id = $obj['id'];
                $shop = $this->Notification_model->get_ShopName($senderID);
                $notification = $obj['notification'];
                $sendTime = $obj['sendTime'];
                $type = "Notification";
                array_push($data, array('id' => $id, 'type' => $type, 'name' => $shop->shopName, 'notification' => $notification, 'sendTime' =>$sendTime));

            }
        }
        else if($person == "provider"){
            $result = $this->Notification_model->get_Reservations($id);
            $data = array();
            foreach ($result as $obj) {
                $rid = $obj->reservationID;
                $price = $obj->totalPrice;
                $reserveDate = $obj->reserveDate;
                $customerID = $obj->customerID;
                $packageName = $obj->packageName;
                $shopID = $obj->shopID;
                $shop = $this->Notification_model->get_ShopName($shopID);
                $customer = $this->Notification_model->Get_Customer($customerID);
                $customerName = $customer->name;
                $customeremail = $customer->email;
                $notification = "$customerName has reserved $packageName from you which costs Rs:$price for $reserveDate <br> Email - $customeremail";
                $type = "Reservation";
                array_push($data, array('id' => $rid,'type' => $type, 'name' => $shop->shopName, 'notification' => $notification));
            }
        }
        echo json_encode($data);
    }

    public function set_Viewed($id,$type) {
        $time = date("Y-m-d h:i:sa");
        $view = array('id' => $id, 'viewedTime' => $time);
        if($type=="reviewedreservation"){
           $this->Notification_model->set_Viewed($view);
        }else if($type=="notification"){
           $this->Notification_model->set_FollowViewed($view);
        }
    }
    public function delete_Notify($id,$type) {
        if($type=="reviewedreservation"){
           $time = date("Y-m-d h:i:sa");
           $view = array('id' => $id, 'viewedTime' => $time);
           $this->Notification_model->set_Viewed($view);
        }else if($type=="notifications"){
           $view = array('id' => $id);
           $this->Notification_model->delete_Notify($view);
        }else if($type=="reservations"){
           $view = array('id' => $id);
           $this->Notification_model->delete_Reservation($view);
        }
    }
    public function set_Accepted($id,$type) {
        $time = date("Y-m-d h:i:sa");
        $view = array('id' => $id, 'acceptedDate' => $time);
        $this->Notification_model->set_Viewed($view);
    }

}

?>