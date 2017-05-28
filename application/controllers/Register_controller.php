<?php
class Register_controller extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('Register_model');
            $this->load->model('Validate');
            $this->load->model('Encryptor');
            
        }
        public function shop_register(){
            $shopid=$password=$shopname=$ownername=$email=$address=$fax=$about="";
            $shopid = $this->input->post('shopid');
            $password = $this->Encryptor->encryptPwrd($this->Validate->get_input($this->input->post('password')));
            $shopname = $this->Validate->get_input($this->input->post('shopname'));
            $ownername = $this->Validate->get_input($this->input->post('ownername'));
            
            $tpnumbers = $this->input->post('tpnumbers');
            /*foreach($tpnumbers as $number){
                    if($this->input->post('txttpnumber'.$i)){
                            $temp = array($this->Validate->get_input($this->input->post('txttpnumber'.$i)),$this->Validate->get_input($this->input->post('txtname'.$i)));
                            array_push($tpnumbers,$temp);
                    }else{
                            break;
                    }
            }*/
            
            $email = $this->Validate->get_input($this->input->post('email'));
            $address = $this->Validate->get_input($this->input->post('address'));
            $fax = $this->Validate->get_input($this->input->post('fax'));
            $about = $this->Validate->get_input($this->input->post('about'));
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
            
            $alert=$this->Register_model->shop_register($data);
            echo json_encode(array('alert'=>$alert));
            
        }
        public function picture_upload($id,$folder,$rORe){ //if registering a person, r will be passed. If a picture is baing updated e will be passed
            if($_FILES[$id]["name"]==""){
                return;
            }
            $validextensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $_FILES[$id]["name"]);
            $file_extension = end($temporary);
            $targtid = "";
            if($folder=="provider")
                $targtid = $this->Register_model->getShopID($_POST["txtemail"]);
            else if($folder=="customer")
                if ($rORe == "r")
                    $targtid = $this->Register_model->getCustomerID($_POST["customeremail"]);
                else
                    $targtid = $this->Register_model->getCustomerID($_POST["custresetemail"]);
            if ($_FILES[$id]["error"] > 0)
            {
                $alert = "Return Code: " . $_FILES[$id]["error"] . "<br/><br/>";
                echo $alert;
                return;
            }
            else
            {
                $name = $targtid."pic.".$file_extension;
                if ($rORe == "r" && file_exists("img/".$folder."/cover/" . $name)) {
                    $alert = $name . " already exists. ";
                    echo $alert;
                    return;
                }
                else
                {
                    $sourcePath = $_FILES[$id]['tmp_name']; // Storing source path of the file in a variable
                    $targetPath = "img/".$folder."/cover/" . $name; // Target path where file is to be stored
                    move_uploaded_file($sourcePath,$targetPath);
                    $alert=$this->Register_model->insert_picture($folder,$targtid,"img/".$folder."/cover/".$name);
                    echo $alert;
                    return;
                    //$alert="aafsdfdfdfgfdhd11111111111111111111111111111111111";

                }
            }
        }
        
        
            public function registerCustomer(){
                
            $custid=$custpass=$custname=$custusername=$custemail=$custaddress=$custtp="";
            $custid = $this->input->post('custid');
            $custpass = $this->Encryptor->encryptPwrd($this->Validate->get_input($this->input->post('custpass')));
            $custname = $this->Validate->get_input($this->input->post('custname'));
            //$custusername = $this->Validate->get_input($this->input->post('custusername'));
            
            $custtp = $this->input->post('custtp');
            
            
            $custemail = $this->Validate->get_input($this->input->post('custemail'));
            $cuspic = $this->input->post('cuspic');
            $custaddress = $this->Validate->get_input($this->input->post('custaddress'));
            
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
            
            $alert=$this->Register_model->registerCustomer($data);
            echo json_encode(array('alert'=>$alert));
            
        
            
        }
        
        public function editCustomer(){
                
            $custresetname=$custresetaddress=$custresettp="";
            
            $custresettp = $this->input->post('custresettp');
            
            
            $custresetname = $this->Validate->get_input($this->input->post('custresetname'));
            $custresetpic = $this->input->post('custresetpic');
            $custresetaddress = $this->Validate->get_input($this->input->post('custresetaddress'));
            
            $data = array(
                    "custresetname" => $custresetname,
                    "custresetaddress" => $custresetaddress,
                    "custresettp" => $custresettp,
                    "custresetpic" => $custresetpic
            );
            
            $alert=$this->Register_model->editCustomerModel($data);
            echo json_encode(array('alert'=>$alert));
            
        }
        
        public function changeCustomerPassword(){
//            $resetoldpass = $resetnewpass="";
            //assuming the same string is encrypted the same way all the time
            $resetoldpass =  $this->Encryptor->encryptPwrd($this->Validate->get_input($this->input->post('custpassresetoldpass')));
            $resetnewpass = $this->Encryptor->encryptPwrd($this->Validate->get_input($this->input->post('custpassresetnewpass')));
            
            
            $data = array(
                    "resetoldpass" => $resetoldpass,
                    "resetnewpass" => $resetnewpass
            );
            
            $alert = $this->Register_model->changeCustomerPasswordModel($data);
            echo json_encode(array('alert'=>$alert));
        }
        
//        public function deleteCustomerAccount(){
//            session_start();
//            $id = $_SESSION['id'];
//            $email = $_SESSION['email'];
//            $person = $_SESSION['person'];
//            $this->Register_model->deleteCustomerAcount($id, $email, $person);
//            
//        }
    }?>