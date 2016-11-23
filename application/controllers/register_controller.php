<?php
class Register_controller extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('register_model');
            $this->load->model('validate');
            $this->load->model('encryptor');
            
        }
        public function shop_register(){
            $shopid=$password=$shopname=$ownername=$email=$address=$fax=$about="";
            $shopid = $this->input->post('shopid');
            $password = $this->encryptor->encryptPwrd($this->validate->get_input($this->input->post('password')));
            $shopname = $this->validate->get_input($this->input->post('shopname'));
            $ownername = $this->validate->get_input($this->input->post('ownername'));
            
            $tpnumbers = $this->input->post('tpnumbers');
            /*foreach($tpnumbers as $number){
                    if($this->input->post('txttpnumber'.$i)){
                            $temp = array($this->validate->get_input($this->input->post('txttpnumber'.$i)),$this->validate->get_input($this->input->post('txtname'.$i)));
                            array_push($tpnumbers,$temp);
                    }else{
                            break;
                    }
            }*/
            
            $email = $this->validate->get_input($this->input->post('email'));
            $address = $this->validate->get_input($this->input->post('address'));
            $fax = $this->validate->get_input($this->input->post('fax'));
            $about = $this->validate->get_input($this->input->post('about'));
            
            $data = array(
                    "shopid" => $shopid,
                    "shopname" => $shopname,
                    "ownername" => $ownername,
                    "email" => $email,
                    "address" => $address,
                    "fax" => $fax,
                    "about" => $about,
                    "picture" => "img/4-2.jpg",
                    "tpnumbers" => $tpnumbers,
                    "password" => $password
            );
            
            $alert=$this->register_model->shop_register($data);
            echo json_encode(array('alert'=>$alert));
            
        }
        public function picture_upload(){
            $validextensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES["file"]["name"]);
            $file_extension = end($temporary);
            $shopid = $this->register_model->getShopID($_POST["txtemail"]);
            
            if ($_FILES["file"]["error"] > 0)
            {
                $alert = "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                echo $alert;
                
            }
            else
            {
                $name = $shopid."pic.".$file_extension;
                if (file_exists("img/shop/cover/" . $name)) {
                    $alert = $name . " already exists. ";
                    echo $alert;
                    
                }
                else
                {
                    $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                    $targetPath = "img/shop/cover/".$name; // Target path where file is to be stored
                    move_uploaded_file($sourcePath,$targetPath);
                    $alert=$this->register_model->insert_picture($shopid,array('picture'=>"img/shop/cover/".$name));
                    echo $alert;
                    //$alert="aafsdfdfdfgfdhd11111111111111111111111111111111111";

                }
            }
            
        }
    }?>