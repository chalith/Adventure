<?php
    class Follow_controller extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('Follow_model');
        }
        public function follow($followerid,$followingid){
            if((bool)$this->Follow_model->follow($followerid,$followingid)){
                echo true;
                return;
            }
        }
        public function unfollow($followerid,$followingid){
            if((bool)$this->Follow_model->unfollow($followerid,$followingid)){
                echo true;
                return;
            }
        }
        public function isfollow($followerid,$followingid){
            if((bool)$this->Follow_model->isfollow($followerid,$followingid)){
                echo 1;
                return;
            }
            echo 0;
        }
    }
?>