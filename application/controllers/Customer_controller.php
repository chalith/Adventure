<?php
    class Customer_controller extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('CustomerModel');
        }
        public function getCustomer($id){
            echo json_encode($this->CustomerModel->get_Customer($id));
        }
    }
?>