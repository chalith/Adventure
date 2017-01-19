<?php

class Notification_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
    }

    public function get_NotificationCount() {
        session_start();
        $id = $_SESSION['id'];
        
        $reservation = $this->notification_model->get_ReviewedReservationCount($id);
        
        $toreviewreservation = $this->notification_model->get_ReservationCount($id);
//      
//            echo json_encode(array('count'=>$reservation));


        $socount = $this->notification_model->get_SONotificationCount($id);
        
        

        $total = $reservation + $socount + $toreviewreservation;
        echo json_encode(array('count' => $total));
    }

    public function get_Notifications() {
        session_start();
        $id = $_SESSION['id'];

//            trial
        $data = array();
<<<<<<< HEAD

        foreach ($result as $obj) {
            $id = $obj->reservationID;
            $package = $this->notification_model->get_ReservedPackege($id);
            $shop = $this->notification_model->get_ShopName($package->shopID);
            array_push($data, array('key' => 0, 'id' => $id, 'package' => $package->packageName, 'shopName' => $shop->shopName));
        }
//            echo json_encode(array('pro' => $data, 'status' => 0));
//            

        $result2 = $this->notification_model->get_FollowNotifications($id);
        foreach ($result2 as $obj) {
            $senderID = $notification = $sendTime = $shop = $id = "";
            $senderID = $obj['senderID'];
            $id = $obj['id'];
            $shop = $this->notification_model->get_ShopName($senderID);
            $notification = $obj['notification'];
            $sendTime = $obj['sendTime'];
            array_push($data, array('key' => 1, 'senderID' => $senderID, 'id' => $id, 'shopName' => $shop->shopName, 'notification' => $notification, 'sendTime' => $sendTime));
        }

        echo json_encode($data);
    }

    public function set_Viewed($reservationID, $key) {
//        session_start();
//        $person = $_SESSION['person'];
        $time = date("Y-m-d h:i:sa");
        if (key == 0) {
            $view = array('reservationID' => $reservationID, 'viewedTime' => $time);
            $this->notification_model->set_Viewed($view);
        } else {
            $view = array('id' => $reservationID, 'viewedTime' => $time);
            $this->notification_model->set_FollowViewed($view);
=======
            
        $person = $_SESSION['person'];
        
        if($person == "customer"){

            $result = $this->notification_model->get_ReviewedReservations($id);
            $data = array();
            foreach ($result as $obj) {
                $rid = $obj->reservationID;
                $package = $this->notification_model->get_ReservedPackege($rid);
                $shop = $this->notification_model->get_ShopName($package->shopID);
                $packageName = $package->packageName;
                $shopName = $shop->shopName;
                $notification = "The $packageName package you have booked from $shopName is reviewed and ready for you";
                $type = "ReviewedReservation";
                array_push($data, array('id' => $rid, 'type' => $type, 'name' => $shop->shopName, 'notification' => $notification));
            }
    //            echo json_encode(array('pro' => $data, 'status' => 0));
    //            

            $result2 = $this->notification_model->get_FollowNotifications($id);

            foreach ($result2 as $obj){
                $senderID = $notification = $sendTime = $shop = $id ="";
                $senderID = $obj['senderID'];
                $id = $obj['id'];
                $shop = $this->notification_model->get_ShopName($senderID);
                $notification = $obj['notification'];
                $sendTime = $obj['sendTime'];
                $type = "Notification";
                array_push($data, array('id' => $id, 'type' => $type, 'name' => $shop->shopName, 'notification' => $notification, 'sendTime' =>$sendTime));

            }
        }
        else if($person == "provider"){
            $result = $this->notification_model->get_Reservations($id);
            $data = array();
            foreach ($result as $obj) {
                $rid = $obj->reservationID;
                $price = $obj->totalPrice;
                $reserveDate = $obj->reserveDate;
                $customerID = $obj->customerID;
                $packageName = $obj->packageName;
                $shopID = $obj->shopID;
                $shop = $this->notification_model->get_ShopName($shopID);
                $customer = $this->notification_model->Get_Customer($customerID);
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
           $this->notification_model->set_Viewed($view);
        }else if($type=="notification"){
           $this->notification_model->set_FollowViewed($view);
        }
    }
    public function delete_Notify($id,$type) {
        if($type=="reviewedreservation"){
           $time = date("Y-m-d h:i:sa");
           $view = array('id' => $id, 'viewedTime' => $time);
           $this->notification_model->set_Viewed($view);
        }else if($type=="notifications"){
           $view = array('id' => $id);
           $this->notification_model->delete_Notify($view);
        }else if($type=="reservations"){
           $view = array('id' => $id);
           $this->notification_model->delete_Reservation($view);
>>>>>>> 8fee93e7ad3bc41b448bc7528c4ce902bf34ca72
        }
    }
    public function set_Accepted($id,$type) {
        $time = date("Y-m-d h:i:sa");
        $view = array('id' => $id, 'acceptedDate' => $time);
        $this->notification_model->set_Viewed($view);
    }

}

?>