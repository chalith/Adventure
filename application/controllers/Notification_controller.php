<?php

class Notification_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
    }

    public function get_NotificationCount() {
        session_start();
        $id = $_SESSION['id'];
        $person = $_SESSION['person'];

        $reservation = $this->notification_model->get_ReviewedReservationCount($id);
//            echo json_encode(array('count'=>$reservation));


        $socount = $this->notification_model->get_SONotificationCount($id);

        $total = $reservation + $socount;
        echo json_encode(array('count' => $total));
    }

    public function get_Notifications() {
        session_start();
        $id = $_SESSION['id'];

//            trial
//            $person = $_SESSION['person'];


        $result = $this->notification_model->get_ReviewedReservations($id);
        $data = array();

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
        }
    }

}

?>