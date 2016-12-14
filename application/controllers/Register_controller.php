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
            $picture = $this->input->post('picture');
            $data = array(
                    "shopid" => $shopid,
                    "shopname" => $shopname,
                    "ownername" => $ownername,
                    "email" => $email,
                    "address" => $address,
                    "fax" => $fax,
                    "about" => $about,
                    "picture" => $picture,
                    "tpnumbers" => $tpnumbers,
                    "password" => $password
            );
            
            $alert=$this->register_model->shop_register($data);
            echo json_encode(array('alert'=>$alert));
            
        }
        public function picture_upload($id,$folder){
            if($_FILES[$id]["name"]==""){
                return;
            }
            $validextensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES[$id]["name"]);
            $file_extension = end($temporary);
            $targtid = "";
            if($folder=="provider")
                $targtid = $this->register_model->getShopID($_POST["txtemail"]);
            else if($folder=="customer")
                $targtid = $this->register_model->getCustomerID($_POST["customeremail"]);
            if ($_FILES[$id]["error"] > 0)
            {
                $alert = "Return Code: " . $_FILES[$id]["error"] . "<br/><br/>";
                echo $alert;
                return;
            }
            else
            {
                $name = $targtid."pic.".$file_extension;
                if (file_exists("img/".$folder."/cover/" . $name)) {
                    $alert = $name . " already exists. ";
                    echo $alert;
                    return;
                }
                else
                {
                    $sourcePath = $_FILES[$id]['tmp_name']; // Storing source path of the file in a variable
                    $targetPath = "img/".$folder."/cover/" . $name; // Target path where file is to be stored
                    move_uploaded_file($sourcePath,$targetPath);
                    $alert=$this->register_model->insert_picture($folder,$targtid,"img/".$folder."/cover/".$name);
                    echo $alert;
                    return;
                    //$alert="aafsdfdfdfgfdhd11111111111111111111111111111111111";

                }
            }
        }
        
        
            public function registerCustomer(){
                
            $custid=$custpass=$custname=$custusername=$custemail=$custaddress=$custtp="";
            $custid = $this->input->post('custid');
            $custpass = $this->encryptor->encryptPwrd($this->validate->get_input($this->input->post('custpass')));
            $custname = $this->validate->get_input($this->input->post('custname'));
            //$custusername = $this->validate->get_input($this->input->post('custusername'));
            
            $custtp = $this->input->post('custtp');
            
            
            $custemail = $this->validate->get_input($this->input->post('custemail'));
            $cuspic = $this->input->post('cuspic');
            $custaddress = $this->validate->get_input($this->input->post('custaddress'));
            
            $data = array(
                    "custid" => $custid,
                    "custname" => $custname,
//                    "custusername" => $custusername,
                    "custemail" => $custemail,
                    "custaddress" => $custaddress,
                    "custtp" => $custtp,
                    "custpass" => $custpass,
                    "cuspic" => $cuspic
            );
            
            $alert=$this->register_model->registerCustomer($data);
            echo json_encode(array('alert'=>$alert));
            
        
            
        }
    }?>